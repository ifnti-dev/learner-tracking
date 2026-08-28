<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Requests\Message;
use App\Models\Apprenant;
use App\Models\Candidat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class CandidatController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view.candidat',only:['index']),
            new Middleware('permission:appouver.candidat',only:['approuver']),
            new Middleware('permission:rejeter.candidat',only:['rejeter']),
        ];
    }

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
    $attributesToFind = $candidat->only(['nom', 'prenom', 'telephone', 'email']);

    $exists = Apprenant::where($attributesToFind)->exists();

    if ($exists) {
        $message = Message::error('Cet apprenant existe déjà avec les mêmes informations !');
        return to_route('candidats.index')->with($message->toMap());
    }

    Apprenant::create($candidat->attributesToArray());
    
    $candidat->delete();

    $message = Message::success('Candidat approuvé avec succès !');
    return to_route('candidats.index')->with($message->toMap());
}


    public function rejeter(Candidat $candidat)
    {
        $candidat->delete();
        $message = Message::success('candidat rejeter  avec success !');

        return to_route('candidats.index')->with($message->toMap());
    }

    public function store(Request $request,Promotion $promotion)
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
            
            
        ]);

        $validated['promotion_id'] = $promotion->id;
        Candidat::create($validated);


        $message = Message::success('candidat inscrit  avec success !');
        if(Auth::check()){
            return to_route('candidats.index')->with($message->toMap());

        }else{
            return to_route('candidater')->with($message->toMap());
        }
    }
}
