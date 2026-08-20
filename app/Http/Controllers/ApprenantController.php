<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message;
use App\Models\Apprenant;
use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\PersonneResponsable;

class ApprenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apprenants = Apprenant::join('candidats', 'apprenants.candidat_id', '=', 'candidats.id')
            ->select('apprenants.*', 'candidats.nom', "candidats.telephone", 'candidats.prenom', 'candidats.email', 'candidats.sexe', 'candidats.adresse')
            ->get();
        return view('apprenants.index', compact('apprenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $candidats = Candidat::whereDoesntHave('apprenant')
            ->get();
        $personnes_reponsables = PersonneResponsable::all();
        return view('apprenants.create', compact('candidats','personnes_reponsables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'etablissement' => 'required|min:1|string',
            'candidat_id' => 'required|integer|exists:candidats,id'
        ]);
        Apprenant::create($validated);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apprenant $apprenant)
    {
        //
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
