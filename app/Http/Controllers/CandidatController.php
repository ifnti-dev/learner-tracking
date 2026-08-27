<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Requests\Message;
use App\Models\Candidat;

class CandidatController extends Controller
{
    public function candidater(Promotion $promotion)
    {

        return view('candidats.inscription', compact('promotion'));
    }

    public function index()
    {
        $candidats = Candidat::all();
        $promotions = Promotion::all();
        return view('candidats.index', compact('candidats','promotions'));
    }

    public function approuver(Candidat $candidat)
    {

       dd('candidat approuver');
    }

    public function rejeter(Candidat $candidat)
    {
        $candidat->delete();
        return to_route('candidats.index');
    }

    public function store(Request $request,Promotion $promotion)
    {
        dd($request->all());
        $validated = $request->validate([
            'nom' => 'required|string|max:255|min:3',
            'prenom' => 'required|string|max:255|min:3',
            'telephone' => 'required|min:4|string|max:20|unique:candidats,telephone',
            'email' => 'required|email|max:255|unique:apprenants,email',
            'sexe' => 'required|in:M,F',
            'adresse' => 'required|string|max:255|min:3',
            'date_naissance' => 'required|date',
            'etablissement' => 'required|string|max:255|min:2',
            'promotion_id' => 'required|integer|exists:promotions,id',
            
        ]);

        
        Candidat::create($validated);


        $message = Message::success('candidat inscrit  avec success !');

        return to_route('apprenants.index')->with($message->toMap());
    }
}
