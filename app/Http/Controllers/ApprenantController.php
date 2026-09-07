<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\ApprenantPersonneResponsable;
use App\Http\Requests\Message;
use App\Models\Apprenant;
use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\Niveau;
use App\Models\PersonneResponsable;
use Illuminate\Validation\Rule;
use App\Models\Bulletin;
use Illuminate\Support\Facades\Storage;
use App\Models\ApprenantNiveau;


use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class ApprenantController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view.apprenant', only: ['index', 'show']),
            new Middleware('permission:create.apprenant', only: ['create', 'store']),
            new Middleware('permission:update.apprenant', only: ['edit', 'update']),
            new Middleware('permission:delete.apprenant', only: ['destroy']),
        ];
    }

    public function index()
    {
        $apprenants = Apprenant::all();
        return view('apprenants.index', compact('apprenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $personne_reponsables = PersonneResponsable::all();
        $niveaux = Niveau::all();

        return view('apprenants.form', compact('personne_reponsables', 'niveaux'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|min:3',
            'prenom' => 'required|string|max:255|min:3',
            'telephone' => 'required|min:4|string|max:20|unique:apprenants,telephone',
            'email' => 'required|email|max:255|unique:apprenants,email',
            'sexe' => 'required|in:M,F',
            'adresse' => 'required|string|max:255|min:3',
            'date_naissance' => 'required|date',
            'etablissement' => 'required|string|max:255|min:2',
            'personne_reponsable_id' => 'nullable|exists:personne_responsables,id',
            'niveau_de_base'  => 'required|integer|exists:niveaux,id',

        ]);

        //bulletins
        //dd($request->all());



        DB::transaction(
            function () use ($validated, $request) {
                $validated['niveau_actuel'] = $validated['niveau_de_base'];

                $cycle_de_base = Niveau::find($validated['niveau_de_base'])->cycle;
                $validated['cycle_de_base'] = $cycle_de_base;

                $apprenant = Apprenant::create($validated);

                $niveaux_ids = Niveau::where('cycle', $cycle_de_base)->pluck('id')->toArray();

                foreach ($niveaux_ids as $niveau_id) {
                    $u = ApprenantNiveau::create([
                        'apprenant_id' => $apprenant->id,
                        'niveau_id' => $niveau_id,

                    ]);
                }



                ApprenantPersonneResponsable::create(
                    [
                        'personne_responsable_id' => $validated['personne_reponsable_id'],
                        'apprenant_id' => $apprenant->id,
                    ]
                );
            }
        );







        $message = Message::success('Apprenant créer avec success !');

        return to_route('apprenants.index')->with($message->toMap());
    }

    /**
     * Display the specified resource.
     */
    public function show(Apprenant $apprenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apprenant $apprenant)
    {
        $personne_reponsables = PersonneResponsable::all();
        $niveaux = Niveau::all();

        return view('apprenants.form', compact('apprenant', 'personne_reponsables', 'niveaux'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apprenant $apprenant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|min:3',
            'prenom' => 'required|string|max:255|min:3',
            'telephone' => [
                'required',
                'min:4',
                'string',
                'max:20',
                Rule::unique('apprenants', 'telephone')->ignore($apprenant->id, 'id'),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'email',
                Rule::unique('apprenants', 'email')->ignore($apprenant->id, 'id'),

            ],
            'sexe' => 'required|in:M,F',
            'adresse' => 'required|string|max:255|min:3',
            'date_naissance' => 'required|date',
            'etablissement' => 'required|string|max:255|min:2',
            'personne_reponsable_id' => 'nullable|exists:personne_responsables,id',
            'niveau_de_base'  => 'required|integer|exists:niveaux,id',
        ]);

        DB::transaction(
            function () use ($validated, $request, $apprenant) {

                if ($validated['niveau_de_base'] != $apprenant->niveau_de_base) {
                    $apprenant_niveaux = ApprenantNiveau::where('apprenant_id', $apprenant->id)->get();
                    foreach ($apprenant_niveaux as $apprenant_niveau) {
                        $bulletin = $apprenant_niveau->bulletin()->first();
                        $paiement = $apprenant_niveau->paiementFrais()->first();

                        if ($bulletin || $paiement) {
                            $message = Message::error('Impossible de changer le nivaux . Ce apprenant a deja des bulletins et/ou des paiements de frais de scolarité pour ce niveau!');
                            return to_route('apprenants.index')->with($message->toMap());
                        }
                    }
                }

                $validated['niveau_actuel'] = $validated['niveau_de_base'];

                $cycle_de_base = Niveau::find($validated['niveau_de_base'])->cycle;
                $validated['cycle_de_base'] = $cycle_de_base;


                $apprenant->update($validated);
                $niveaux_ids = Niveau::where('cycle', $cycle_de_base)->pluck('id')->toArray();

                $apprenant_niveaux = ApprenantNiveau::where('apprenant_id', $apprenant->id)->get();
                foreach ($apprenant_niveaux as $apprenant_niveau) {
                    $apprenant_niveau->delete();
                }


                foreach ($niveaux_ids as $niveau_id) {
                    $u = ApprenantNiveau::create([
                        'apprenant_id' => $apprenant->id,
                        'niveau_id' => $niveau_id,
                    ]);
                }





                ApprenantPersonneResponsable::firstOrCreate([
                    'apprenant_id' => $apprenant->id,
                    'personne_responsable_id' => $validated['personne_reponsable_id']
                ]);
            }
        );



        $message = Message::success('Apprenant â été mofifier avec success !');

        return to_route('apprenants.index')->with($message->toMap());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apprenant $apprenant)
    {
        $apprenant->delete();
        $message = Message::success('Apprenant supprimer avec success !');

        return to_route('apprenants.index')->with($message->toMap());
    }
}
