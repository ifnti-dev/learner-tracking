<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message;
use App\Models\Bulletin;
use Illuminate\Http\Request;
use App\Models\Apprenant;
use App\Models\Niveau;
use App\Models\Annee;
use Illuminate\Support\Facades\DB;
use App\Models\ApprenantNiveau;
use Illuminate\Support\Facades\Storage;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class BulletinController extends Controller implements HasMiddleware
{
        public static function middleware(): array
    {
        return [
            new Middleware('permission:view.bulletin', only: ['bulletins', 'show']),
            new Middleware('permission:create.bulletin', only: ['create', 'store']),
            new Middleware('permission:update.bulletin', only: ['edit', 'update']),
            new Middleware('permission:delete.bulletin', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Apprenant $apprenant)

    {
        //  
    }
    public function bulletins(Apprenant $apprenant)
    {

        $bulletins = Bulletin::whereIn('apprenant_niveau_id', $apprenant->apprenantNiveaux()->pluck('id'))
            ->with('apprenantNiveau')
            ->get();



        return view('bulletins.index', compact('bulletins', 'apprenant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Apprenant $apprenant)
    {
        $annee_scolaires = Annee::all();

        $incomplet_bulletin = Bulletin::whereIn('apprenant_niveau_id', $apprenant->apprenantNiveaux->pluck('id'))
            ->where('status', 'incomplet')
            ->with('apprenantNiveau.annee')
            ->first();

        if ($incomplet_bulletin) {
            $anneeScolaireNom = $incomplet_bulletin->apprenantNiveau->annee->annee_scolaire;

            $messages = Message::info("Le bulletin pour l'année scolaire {$anneeScolaireNom} est incomplet. Veuillez le compléter avant d'ajouter un nouveau bulletin.");

            return redirect()->back()->with($messages->toMap());
        }

        $niveauActuel = Niveau::find($apprenant->niveau_actuel);

        $niveaux = $niveauActuel
            ? $apprenant->niveaux()->where('code', '<=', $niveauActuel->code)->distinct()->get()
            : collect();


        return view('bulletins.form', compact('apprenant', 'annee_scolaires', 'niveaux'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Apprenant $apprenant)
    {

        $validated = $request->validate([
            'bulletin1' => 'nullable|file|mimes:pdf',
            'bulletin2' => 'nullable|file|mimes:pdf',
            'bulletin3' => 'nullable|file|mimes:pdf',
            'releveCEPD' => 'nullable|file|mimes:pdf',
            'releveBEPC' => 'nullable|file|mimes:pdf',
            'releveBAC1' => 'nullable|file|mimes:pdf',
            'releveBAC2' => 'nullable|file|mimes:pdf',
            "niveau_id" => "required|exists:niveaux,id",
            'annee_scolaire'  => 'required|exists:annees,id'
        ]);

        $appNiveaux = ApprenantNiveau::where('apprenant_id', $apprenant->id)
            ->where('annee_id', $validated["annee_scolaire"])->first();

        if ($appNiveaux) {
            if ($appNiveaux->bulletin()->first()) {
                $messages = Message::error('Un bulletin pour cette année scolaire  existe déjà pour cet apprenant.');

                return redirect()->back()->withInput()->with($messages->toMap());
            }
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


        DB::transaction(function () use ($validated, $files_path, $apprenant) {

            $appNiveau = ApprenantNiveau::firstOrCreate(
                [
                    'apprenant_id' => $apprenant->id,
                    'annee_id' => $validated["annee_scolaire"],
                ],
                [
                    'niveau_id' => $validated["niveau_id"],
                ]
            );



            Bulletin::create([
                'bulletin1' => $files_path['bulletin1'] ?? null,
                'bulletin2' => $files_path['bulletin2'] ?? null,
                'bulletin3' => $files_path['bulletin3'] ?? null,
                'releveCEPD' => $files_path['releveCEPD'] ?? null,
                'releveBEPC' => $files_path['releveBEPC'] ?? null,
                'releveBAC1' => $files_path['releveBAC1'] ?? null,
                'releveBAC2' => $files_path['releveBAC2'] ?? null,

                "status" => $validated["status"],
                'apprenant_niveau_id' => $appNiveau->id,

            ]);
        });



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
        $annee_scolaires = Annee::all();

        $niveauActuel = Niveau::find($apprenant->niveau_actuel);

        $niveaux = $niveauActuel
            ? $apprenant->niveaux()->where('code', '<=', $niveauActuel->code)->distinct()->get()
            : collect();

        return view('bulletins.form', compact('apprenant', 'annee_scolaires', 'niveaux', 'bulletin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bulletin $bulletin, Apprenant $apprenant)
    {
        $validated = $request->validate([
            'bulletin1' => 'nullable|file|mimes:pdf',
            'bulletin2' => 'nullable|file|mimes:pdf',
            'bulletin3' => 'nullable|file|mimes:pdf',
            'releveCEPD' => 'nullable|file|mimes:pdf',
            'releveBEPC' => 'nullable|file|mimes:pdf',
            'releveBAC1' => 'nullable|file|mimes:pdf',
            'releveBAC2' => 'nullable|file|mimes:pdf',
            "niveau_id" => "required|exists:niveaux,id",

            'annee_scolaire'  => 'required|exists:annees,id'
        ]);

        if ($bulletin->apprenantNiveau()->first()->annee()->first()->id != $validated['annee_scolaire']) {
            $appNiveaux = ApprenantNiveau::where('apprenant_id', $apprenant->id)
                ->where('annee_id', $validated["annee_scolaire"])->first();

            if ($appNiveaux) {
                $messages = Message::error('Un bulletin pour cette année scolaire  existe déjà pour cet apprenant.');

                return redirect()->back()->withInput()->with($messages->toMap());
            }
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

        DB::transaction(function () use ($validated, $files_path, $apprenant, $bulletin) {





            $appNiveau = ApprenantNiveau::firstOrCreate(
                [
                    'apprenant_id' => $apprenant->id,
                    'annee_id' => $validated["annee_scolaire"],
                ],
                [
                    'niveau_id' => $validated["niveau_id"],
                ]
            );




            $bulletin->update([
                'bulletin1' => $files_path['bulletin1'],
                'bulletin2' => $files_path['bulletin2'],
                'bulletin3' => $files_path['bulletin3'],
                'releveCEPD' => $files_path['releveCEPD'],
                'releveBEPC' => $files_path['releveBEPC'],
                'releveBAC1' => $files_path['releveBAC1'],
                'releveBAC2' => $files_path['releveBAC2'],

                "status" => $validated["status"],

                'apprenant_niveau_id' => $appNiveau->id,
            ]);
        });



        $messages = Message::success('Bulletins mis à jour avec succès');

        return to_route('bulletins', $apprenant)->with($messages->toMap());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bulletin $bulletin)
    {
        if ($bulletin->bulletin1) {
            Storage::delete('public/' . $bulletin->bulletin1);
        }
        if ($bulletin->bulletin2) {
            Storage::delete('public/' . $bulletin->bulletin2);
        }
        if ($bulletin->bulletin3) {
            Storage::delete('public/' . $bulletin->bulletin3);
        }
        if ($bulletin->releveCEPD) {
            Storage::delete('public/' . $bulletin->releveCEPD);
        }
        if ($bulletin->releveBEPC) {
            Storage::delete('public/' . $bulletin->releveBEPC);
        }
        if ($bulletin->releveBAC1) {
            Storage::delete('public/' . $bulletin->releveBAC1);
        }
        if ($bulletin->releveBAC2) {
            Storage::delete('public/' . $bulletin->releveBAC2);
        }

        $appNiveaux = $bulletin->apprenantNiveau()->first();
        $bulletin->delete();
        if ($appNiveaux->paiementFrai()->first() == null) {

            $appNiveaux->delete();
        }
        $messages = Message::success('Bulletins supprimé avec succès');
        return redirect()->back()->with($messages->toMap());
    }
}
