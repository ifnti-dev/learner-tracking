<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message;
use App\Models\Bulletin;
use Illuminate\Http\Request;
use App\Models\Apprenant;
use App\Models\Niveau;
use Illuminate\Support\Facades\Storage;
class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Apprenant $apprenant)

    {
        //
    }
    public function bulletins(Apprenant $apprenant)

    {

        $bulletins = Bulletin::where("apprenant_id", $apprenant->id)
        ->orderBy('annee_scolaire', 'desc')
        ->get();
        return view('bulletins.index', compact('bulletins', 'apprenant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Apprenant $apprenant)
    {
        //si une annee scolaire a un buletin de status incomplet alors return error
        $incomplet_bulletin = Bulletin::where("apprenant_id", $apprenant->id)->where("status", "incomplet")->first();
        if ($incomplet_bulletin) {
            $messages = Message::info("Bulletin pour l'année scolaire " . $incomplet_bulletin->annee_scolaire . " est incomplet. Veuillez le compléter avant d'ajouter un nouveau bulletin.");
            return redirect()->back()->with($messages->toMap());
        }
        //determination de l'annee scolaire
        $fin  = (int)date('Y') + 1;
        $debut = $fin - 7;
        $compteur = $fin - $debut;
        $annee_scolaires  = [];
        for ($i = 0; $i < $compteur; $i++) {
            $annee_scolaires[] = ($debut + $i) . '-' . ($debut + $i + 1);
        }
        $annee_scolaires = array_reverse($annee_scolaires);
        $niveaux = Niveau::all();
        return view('bulletins.form', compact('apprenant', 'annee_scolaires', 'niveaux'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Apprenant $apprenant)
    {

        $validated = $request->validate([
            'bulletin1' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'bulletin2' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'bulletin3' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'releveCEPD' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'releveBEPC' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'releveBAC1' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'releveBAC2' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            "niveau_id" => "required|exists:niveaux,id",
            "annee_scolaire" => "required",
        ]);
        $bulletin_apprenant = $apprenant->bulletins()->where('annee_scolaire', $request->annee_scolaire)->first();

        if ($bulletin_apprenant) {
            $messages = Message::error('Un ou des bulletin(s) pour cette année scolaire existe déjà pour cet apprenant.');
            return redirect()->back()->with($messages->toMap());
        }

        $store_path = 'bulletins/' . $apprenant->id . '/' . $validated["niveau_id"] . '/' . $validated["annee_scolaire"];
        $files_path = [];
        $nbr_bulletins = 0;


        if ($request->hasFile('bulletin1')) {
            $file_name =  'bulletin1' . '.' . $request->file('bulletin1')->extension();
            $files_path['bulletin1'] = $request->file('bulletin1')->storeAs($store_path, $file_name, 'public');
            $nbr_bulletins++;
        }

        if ($request->hasFile('bulletin2')) {
            $file_name =  'bulletin2' . '.' . $request->file('bulletin2')->extension();
            $files_path['bulletin2'] = $request->file('bulletin2')->storeAs($store_path, $file_name, 'public');
            $nbr_bulletins++;
        }

        if ($request->hasFile('bulletin3')) {
            $file_name =  'bulletin3' . '.' . $request->file('bulletin3')->extension();
            $files_path['bulletin3'] = $request->file('bulletin3')->storeAs($store_path, $file_name, 'public');
            $nbr_bulletins++;
        }

        //si 6eme

        if ($request->hasFile('releveCEPD')) {

            if ($request->niveau_id == Niveau::where('nom', '6ème')->first()->id) {
                $file_name =  'releveCEPD' . '.' . $request->file('releveCEPD')->extension();
                $files_path['releveCEPD'] = $request->file('releveCEPD')->storeAs($store_path, $file_name, 'public');
                $nbr_bulletins++;
            }
        }

        //si Seconde
        if ($request->hasFile('releveBEPC')) {
            if ($request->niveau_id == Niveau::where('nom', 'Seconde')->first()->id) {
                $file_name =  'releveBEPC' . '.' . $request->file('releveBEPC')->extension();
                $files_path['releveBEPC'] = $request->file('releveBEPC')->storeAs($store_path, $file_name, 'public');
                $nbr_bulletins++;
            }
        }

        //si Terminale
        if ($request->hasFile('releveBAC1')) {
            if ($request->niveau_id == Niveau::where('nom', 'Terminale')->first()->id) {
                $file_name =  'releveBAC1' . '.' . $request->file('releveBAC1')->extension();
                $files_path['releveBAC1'] = $request->file('releveBAC1')->storeAs($store_path, $file_name, 'public');
                $nbr_bulletins++;
            }
        }

        if ($request->hasFile('releveBAC2')) {
            if ($request->niveau_id == Niveau::where('nom', 'Terminale')->first()->id) {
                $file_name =  'releveBAC2' . '.' . $request->file('releveBAC2')->extension();
                $files_path['releveBAC2'] = $request->file('releveBAC2')->storeAs($store_path, $file_name, 'public');
                $nbr_bulletins++;
            }
        }

        $validated['status'] = 'complet';
        if ($request->niveau_id == Niveau::where('nom', 'Terminale')->first()->id && $nbr_bulletins < 5) {
            $validated['status'] = 'incomplet';
        }
        if ($request->niveau_id == Niveau::where('nom', 'Seconde')->first()->id && $nbr_bulletins < 4) {
            $validated['status'] = 'incomplet';
        }
        if ($request->niveau_id == Niveau::where('nom', '6ème')->first()->id && $nbr_bulletins < 4) {
            $validated['status'] = 'incomplet';
        }


        if ($nbr_bulletins < 3) {
            $validated['status'] = 'incomplet';
        }

        Bulletin::create([
            'bulletin1' => $files_path['bulletin1'] ?? null,
            'bulletin2' => $files_path['bulletin2'] ?? null,
            'bulletin3' => $files_path['bulletin3'] ?? null,
            'releveCEPD' => $files_path['releveCEPD'] ?? null,
            'releveBEPC' => $files_path['releveBEPC'] ?? null,
            'releveBAC1' => $files_path['releveBAC1'] ?? null,
            'releveBAC2' => $files_path['releveBAC2'] ?? null,
            "niveau_id" => $validated["niveau_id"],
            "apprenant_id" => $apprenant->id,
            "status" => $validated["status"],
            'annee_scolaire' => $validated["annee_scolaire"],
        ]);



        $messages = Message::success('Bulletins ajouté avec succès');

        return to_route('bulletins', $apprenant)->with($messages->toMap());
    }

    /**
     * Display the specified resource.
     */
    public function show(Bulletin $bulletin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bulletin $bulletin, Apprenant $apprenant)
    {
        $fin  = (int)date('Y') + 1;
        $debut = $fin - 7;
        $compteur = $fin - $debut;
        $annee_scolaires  = [];
        for ($i = 0; $i < $compteur; $i++) {
            $annee_scolaires[] = ($debut + $i) . '-' . ($debut + $i + 1);
        }
        $annee_scolaires = array_reverse($annee_scolaires);
        $niveaux = Niveau::all();
        return view('bulletins.form', compact('apprenant', 'annee_scolaires', 'niveaux', 'bulletin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bulletin $bulletin,Apprenant $apprenant)
    {
        $validated = $request->validate([
            'bulletin1' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'bulletin2' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'bulletin3' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'releveCEPD' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'releveBEPC' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'releveBAC1' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'releveBAC2' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            "niveau_id" => "required|exists:niveaux,id",
            "annee_scolaire" => "required",
        ]);

        
        $duplicate_bulletin = $apprenant->bulletins()
            ->where('annee_scolaire', $validated['annee_scolaire'])
            ->where('id', '!=', $bulletin->id)
            ->first();

        if ($duplicate_bulletin) {
            $messages = Message::error('Un ou des bulletin(s) pour cette année scolaire existe déjà pour cet apprenant.');
            return redirect()->back()->with($messages->toMap());
        }

        $store_path = 'bulletins/' . $apprenant->id . '/' . $validated["niveau_id"] . '/' . $validated["annee_scolaire"];

       
        $files_path = [
            'bulletin1' => $bulletin->bulletin1,
            'bulletin2' => $bulletin->bulletin2,
            'bulletin3' => $bulletin->bulletin3,
            'releveCEPD' => $bulletin->releveCEPD,
            'releveBEPC' => $bulletin->releveBEPC,
            'releveBAC1' => $bulletin->releveBAC1,
            'releveBAC2' => $bulletin->releveBAC2,
        ];

        $niveau_nom = Niveau::where('id', $validated['niveau_id'])->first()->nom;

        
        for ($i = 1; $i <= 3; $i++) {
            $key = "bulletin{$i}";
            if ($request->hasFile($key)) {
                if (!empty($files_path[$key])) {
                    Storage::disk('public')->delete($files_path[$key]);
                }
                $file_name = $key . '.' . $request->file($key)->extension();
                $files_path[$key] = $request->file($key)->storeAs($store_path, $file_name, 'public');
            }
        }

        
        $conditional_documents = [
            'releveCEPD' => '6ème',
            'releveBEPC' => 'Seconde',
            'releveBAC1' => 'Terminale',
            'releveBAC2' => 'Terminale',
        ];

        foreach ($conditional_documents as $input_name => $required_niveau) {
            if ($niveau_nom !== $required_niveau) {
                if (!empty($files_path[$input_name])) {
                    Storage::disk('public')->delete($files_path[$input_name]);
                }
                $files_path[$input_name] = null;
                continue;
            }

            if ($request->hasFile($input_name)) {
                if (!empty($files_path[$input_name])) {
                    Storage::disk('public')->delete($files_path[$input_name]);
                }
                $file_name = $input_name . '.' . $request->file($input_name)->extension();
                $files_path[$input_name] = $request->file($input_name)->storeAs($store_path, $file_name, 'public');
            }
        }

        $nbr_bulletins = 0;
        foreach ($files_path as $path) {
            if (!empty($path)) {
                $nbr_bulletins++;
            }
        }

        $required_count = 3;
        if ($niveau_nom === 'Terminale') {
            $required_count = 5;
        } elseif ($niveau_nom === 'Seconde' || $niveau_nom === '6ème') {
            $required_count = 4;
        }

        $validated['status'] = ($nbr_bulletins >= $required_count) ? 'complet' : 'incomplet';

        
        $bulletin->update([
            'bulletin1' => $files_path['bulletin1'],
            'bulletin2' => $files_path['bulletin2'],
            'bulletin3' => $files_path['bulletin3'],
            'releveCEPD' => $files_path['releveCEPD'],
            'releveBEPC' => $files_path['releveBEPC'],
            'releveBAC1' => $files_path['releveBAC1'],
            'releveBAC2' => $files_path['releveBAC2'],
            "niveau_id" => $validated["niveau_id"],
            "status" => $validated["status"],
            'annee_scolaire' => $validated["annee_scolaire"],
        ]);

        $messages = Message::success('Bulletins mis à jour avec succès');

        return to_route('bulletins', $apprenant)->with($messages->toMap());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bulletin $bulletin)
    {
        $bulletin->delete();
        $messages = Message::success('Bulletins supprimé avec succès');
        return redirect()->back()->with($messages->toMap());
    }
}
