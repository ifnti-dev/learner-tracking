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

class ApprenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $niveau = Niveau::all();
        return view('apprenants.create', compact('personne_reponsables','niveau'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'nom' => 'required|string|max:255|min:3',
            'prenom' => 'required|string|max:255|min:3',
            'telephone' => 'required|min:4|string|max:20|unique:candidats,telephone',
            'email' => 'required|email|max:255|unique:candidats,email',
            'sexe' => 'required|in:M,F',
            'adresse' => 'required|string|max:255|min:3',
            'date_naissance' => 'required|date',
            'etablissement' => 'required|string|max:255|min:2',
            'personne_reponsable_id' => 'nullable|exists:personne_responsables,id',
        ]);
        DB::transaction(
            function () use ($validated) {
                $apprenant = Apprenant::create($validated);
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
        

        return view('apprenants.edit', compact('apprenant', 'personne_reponsables'));
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
        ]);

        $apprenant->update($validated);



        $message = Message::success('Apprenant créer avec success !');

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
