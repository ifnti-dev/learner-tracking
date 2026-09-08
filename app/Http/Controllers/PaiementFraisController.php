<?php

namespace App\Http\Controllers;


use App\Models\PaiementFrais;
use Illuminate\Http\Request;
use App\Models\Niveau;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use App\Models\Apprenant;
use App\Http\Requests\Message;
use App\Models\Annee;
use App\Models\ApprenantNiveau;
use Illuminate\Support\Facades\DB;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;


class PaiementFraisController extends Controller implements HasMiddleware
{
        public static function middleware(): array
    {
        return [
            new Middleware('permission:view.paiement_frais', only: ['index', 'show']),
            new Middleware('permission:create.paiement_frais', only: ['create', 'store']),
            new Middleware('permission:update.paiement_frais', only: ['edit', 'update']),
            new Middleware('permission:delete.paiement_frais', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Apprenant $apprenant)
    {
        $paiementFrais = PaiementFrais::whereIn('apprenant_niveau_id', $apprenant->apprenantNiveaux()->pluck('id'))
            ->with('apprenantNiveau')
            ->get();
        return view('paiement_frais.index', compact('paiementFrais', 'apprenant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Apprenant $apprenant)
    {
        //determination de l'annee scolaire


        $annee_scolaires = Annee::all();
        $incomplet_paiement_frais = PaiementFrais::whereIn('apprenant_niveau_id', $apprenant->apprenantNiveaux->pluck('id'))
            ->where('verse', 0)
            ->with('apprenantNiveau.annee')
            ->first();

        if ($incomplet_paiement_frais) {
            $anneeScolaireNom = $incomplet_paiement_frais->apprenantNiveau->annee->annee_scolaire;

            $messages = Message::info("Le paiement de scolarité pour l'année scolaire {$anneeScolaireNom} n'est pas versé. Veuillez le solder avant d'ajouter un nouveau paiement de scolarité.");

            return redirect()->back()->with($messages->toMap());
        }

        $niveauActuel = Niveau::find($apprenant->niveau_actuel);

        $niveaux = $niveauActuel
            ? $apprenant->niveaux()->where('code', '<=', $niveauActuel->code)->distinct()->get()
            : collect();

        return view('paiement_frais.form', compact('apprenant', 'annee_scolaires', 'niveaux'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Apprenant $apprenant)
    {
        $validatedData = $request->validate([
            'montant' => 'required|numeric',
            'annee_scolaire' => 'required|string|exists:annees,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'piece_justificatif' => 'nullable|file|mimes:pdf',
        ]);
        $appNiveaux = ApprenantNiveau::where('apprenant_id', $apprenant->id)
            ->where('annee_id', $validatedData["annee_scolaire"])->first();

        if ($appNiveaux) {
            if ($appNiveaux->paiementFrai()->first()) {
                $messages = Message::error('Un paiement de frais de scolarité pour cette année scolaire  existe déjà pour cet apprenant.');

                return redirect()->back()->withInput()->with($messages->toMap());
            }
        }


        $store_path = 'justificatifs/' . $apprenant->id . '/' . $validatedData["niveau_id"] . '/' . $validatedData["annee_scolaire"];
        $files_path = null;
        $validatedData['verse'] = 0;
        if ($request->hasFile('piece_justificatif')) {
            $file_name =  'piece_justificatif' . '.' . $request->file('piece_justificatif')->extension();
            $files_path  = $request->file('piece_justificatif')->storeAs($store_path, $file_name, 'public');
            $validatedData['verse'] = 1;
        }

        DB::transaction(function () use ($validatedData, $files_path, $apprenant) {

            $appNiveau = ApprenantNiveau::firstOrCreate(
                [
                    'apprenant_id' => $apprenant->id,
                    'annee_id' => $validatedData["annee_scolaire"],
                ],
                [
                    'niveau_id' => $validatedData["niveau_id"],
                ]
            );

            PaiementFrais::create([
                'apprenant_niveau_id' => $appNiveau->id,
                'montant' => $validatedData['montant'],
                'annee_scolaire' => $validatedData['annee_scolaire'],
                'verse' => $validatedData['verse'],
                'piece_justificatif' => $files_path ?? null,
            ]);
        });


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
        $annee_scolaires = Annee::all();

        $niveauActuel = Niveau::find($apprenant->niveau_actuel);

        $niveaux = $niveauActuel
            ? $apprenant->niveaux()->where('code', '<=', $niveauActuel->code)->distinct()->get()
            : collect();

        return view('paiement_frais.form', compact('apprenant', 'niveaux', 'paiementFrais', 'annee_scolaires'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, PaiementFrais $paiementFrais, Apprenant $apprenant)
    {
        $validatedData = $request->validate([
            'montant' => 'required|numeric',
            'annee_scolaire' => 'required|string|exists:annees,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'piece_justificatif' => 'nullable|file|mimes:pdf',
        ]);

        if ($paiementFrais->apprenantNiveau()->first()->annee()->first()->id != $validatedData['annee_scolaire']) {
            $appNiveaux = ApprenantNiveau::where('apprenant_id', $apprenant->id)
                ->where('annee_id', $validatedData["annee_scolaire"])->first();

            if ($appNiveaux) {
                $messages = Message::error('Un paiement de frais pour cette année scolaire  existe déjà pour cet apprenant.');

                return redirect()->back()->withInput()->with($messages->toMap());
            }
        }

        $files_path = $paiementFrais->piece_justificatif;
        $validatedData['verse'] = $paiementFrais->verse;

        if ($request->hasFile('piece_justificatif')) {
            if ($paiementFrais->piece_justificatif && Storage::disk('public')->exists($paiementFrais->piece_justificatif)) {
                Storage::disk('public')->delete($paiementFrais->piece_justificatif);
            }

            $store_path = 'justificatifs/' . $apprenant->id . '/' . $validatedData["niveau_id"] . '/' . $validatedData["annee_scolaire"];
            $file_name = 'piece_justificatif.' . $request->file('piece_justificatif')->extension();
            $files_path = $request->file('piece_justificatif')->storeAs($store_path, $file_name, 'public');
            $validatedData['verse'] = 1;
        }

        DB::transaction(function () use ($validatedData, $files_path, $apprenant, $paiementFrais) {

            $appNiveau = ApprenantNiveau::firstOrCreate(
                [
                    'apprenant_id' => $apprenant->id,
                    'annee_id' => $validatedData["annee_scolaire"],
                ],
                [
                    'niveau_id' => $validatedData["niveau_id"],
                ]
            );

            $paiementFrais->update([
                'apprenant_niveau_id' => $appNiveau->id,
                'montant' => $validatedData['montant'],
                'annee_scolaire' => $validatedData['annee_scolaire'],
                'verse' => $validatedData['verse'],
                'piece_justificatif' => $files_path,
            ]);
        });

        $messages = Message::success('Paiement de frais de scolarité modifié avec succès.');
        return to_route('paiement_frais', $apprenant)->with($messages->toMap());
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaiementFrais $paiementFrais)
    {
        if ($paiementFrais->piece_justificatif) {
            Storage::delete('public/' . $paiementFrais->piece_justificatif);
        }

        $appNiveaux = $paiementFrais->apprenantNiveau()->first();
        $paiementFrais->delete();
        if ($appNiveaux->bulletin()->first() == null) {

            $appNiveaux->delete();
        }
        $messages = Message::success('Paiement de frais de scolarité supprimé avec succès.');
        return redirect()->back()->with($messages->toMap());
    }
}
