<?php

namespace App\Http\Controllers;

use App\Models\PaiementFrais;
use Illuminate\Http\Request;
use App\Models\Niveau;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use App\Models\Apprenant;
use App\Http\Requests\Message;


class PaiementFraisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Apprenant $apprenant)
    {
        $paiementFrais = PaiementFrais::where('apprenant_id', $apprenant->id)
            ->get();
        return view('paiement_frais.index', compact('paiementFrais', 'apprenant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Apprenant $apprenant)
    {
        //determination de l'annee scolaire


        $niveaux = Niveau::join("bulletins", "niveaux.id", "=", "bulletins.niveau_id")
            ->where("bulletins.apprenant_id", $apprenant->id)
            ->select("niveaux.*", "bulletins.annee_scolaire")
            ->distinct()
            ->get();
        return view('paiement_frais.form', compact('apprenant', 'niveaux'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Apprenant $apprenant)
    {
        $validatedData = $request->validate([
            'montant' => 'required|numeric',
            'annee_scolaire' => 'required|string',
            'niveau_id' => 'required|exists:niveaux,id',
            'piece_justificatif' => 'nullable|file|mimes:pdf',
        ]);
        //verivier si on a deja au moin un bulletin pour ce niveau et cette annee scolaire
        $bulletin_apprenant = $apprenant->bulletins()->where('annee_scolaire', $request->annee_scolaire)
            ->where('niveau_id', $request->niveau_id)
            ->first();

        if (!$bulletin_apprenant) {
            $messages = Message::info("Vous ne pouvez pas effectuer un paiement de frais de scolarité pour cet apprenant car il n'a pas de bulletin pour l'année scolaire " . $request->annee_scolaire . " et le niveau " . $request->niveau_id . ".    Veuillez d'abord ajouter un bulletin pour cet apprenant pour cette année scolaire et ce niveau avant de procéder au paiement des frais de scolarité.");
            return redirect()->back()->with($messages->toMap());
        }

        $paiementFrais = PaiementFrais::where('apprenant_id', $apprenant->id)
            ->where('niveau_id', $validatedData['niveau_id'])
            ->where('annee_scolaire', $validatedData['annee_scolaire'])
            ->first();
        if ($paiementFrais) {
            $messages = Message::error('Un paiement de frais de scolarité existe déjà pour cet apprenant pour l\'année scolaire et le niveau ' . $validatedData['niveau_id'] . '.');
            return redirect()->back()->with($messages->toMap());
        }
        $store_path = 'justificatifs/' . $apprenant->id . '/' . $validatedData["niveau_id"] . '/' . $validatedData["annee_scolaire"];

        if ($request->hasFile('piece_justificatif')) {
            $file_name =  'piece_justificatif' . '.' . $request->file('piece_justificatif')->extension();
            $files_path  = $request->file('piece_justificatif')->storeAs($store_path, $file_name, 'public');
           
        }

        PaiementFrais::create([
            'apprenant_id' => $apprenant->id,
            'montant' => $validatedData['montant'],
            'annee_scolaire' => $validatedData['annee_scolaire'],
            'niveau_id' => $validatedData['niveau_id'],
            'piece_justificatif' => $files_path ?? null,
        ]);
        $messages = Message::success('Paiement de frais de scolarité enregistré avec succès.');
        return to_route('paiement_frais', $apprenant)->with($messages->toMap());
    }

    /**
     * Display the specified resource.
     */
    public function show(PaiementFrais $paiementFrais)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaiementFrais $paiementFrais, Apprenant $apprenant)
    {
        $niveaux = Niveau::join("bulletins", "niveaux.id", "=", "bulletins.niveau_id")
            ->where("bulletins.apprenant_id", $apprenant->id)
            ->select("niveaux.*", "bulletins.annee_scolaire")
            ->distinct()
            ->get();

        return view('paiement_frais.form', compact('apprenant', 'niveaux', 'paiementFrais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaiementFrais $paiementFrais)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaiementFrais $paiementFrais)
    {
        if ($paiementFrais->piece_justificatif) {
            Storage::delete('public/' . $paiementFrais->piece_justificatif);
        }
        $paiementFrais->delete();
        $messages = Message::success('Paiement de frais de scolarité supprimé avec succès.');
        return redirect()->back()->with($messages->toMap());
    }
}
