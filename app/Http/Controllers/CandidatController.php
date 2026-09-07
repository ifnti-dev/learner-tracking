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
use App\Models\Niveau;
use App\Models\ApprenantNiveau;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class CandidatController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view.candidat', only: ['index']),
            new Middleware('permission:appouver.candidat', only: ['approuver']),
            new Middleware('permission:rejeter.candidat', only: ['rejeter']),
        ];
    }

    public function candidater(Promotion $promotion)
    {
        $niveaux = Niveau::all();

        return view('candidats.inscription', compact('promotion','niveaux'));
    }

    public function index()
    {
        $candidats = Candidat::all();
        $promotions = Promotion::all();
        
        return view('candidats.index', compact('candidats', 'promotions'));
    }

    public function approuver(Candidat $candidat)
    {
        $attributesToFind = $candidat->only(['nom', 'prenom', 'telephone', 'email']);

        $exists = Apprenant::where($attributesToFind)->exists();

        if ($exists) {
            $message = Message::error('Cet apprenant existe déjà avec les mêmes informations !');
            return to_route('candidats.index')->with($message->toMap());
        }

        DB::transaction(function () use($candidat) {

            $apprenant = Apprenant::create($candidat->attributesToArray());
            $cycle_de_base = Niveau::find($candidat->niveau_de_base)->cycle;

            $niveaux_ids = Niveau::where('cycle', $cycle_de_base)->pluck('id')->toArray();

            foreach ($niveaux_ids as $niveau_id) {
                $u = ApprenantNiveau::create([
                    'apprenant_id' => $apprenant->id,
                    'niveau_id' => $niveau_id,

                ]);
            }


            $candidat->delete();
        });



        $message = Message::success('Candidat approuvé avec succès !');
        return to_route('candidats.index')->with($message->toMap());
    }


    public function rejeter(Candidat $candidat)
    {
        $candidat->delete();
        $message = Message::success('candidat rejeter  avec success !');

        return to_route('candidats.index')->with($message->toMap());
    }

    public function store(Request $request, Promotion $promotion)
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
            'niveau_de_base'  => 'required|integer|exists:niveaux,id',

        ]);

        $validated['promotion_id'] = $promotion->id;
        if ($promotion->date_limite > now() || $promotion->est_active == 'non') {
            $message = Message::error("Fin du delais d' inscription !");
            return to_route('candidater', $promotion)->with($message->toMap());
        }
        $validated['niveau_actuel'] = $validated['niveau_de_base'];

        $cycle_de_base = Niveau::find($validated['niveau_de_base'])->cycle;
        $validated['cycle_de_base'] = $cycle_de_base;
        Candidat::create($validated);


        $message = Message::success('candidat inscrit  avec success !');
        if (Auth::check()) {
            return to_route('candidats.index')->with($message->toMap());
        } else {
            return to_route('candidater', $promotion)->with($message->toMap());
        }
    }
}
