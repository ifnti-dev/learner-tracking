<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use Illuminate\Http\Request;
use App\Models\Apprenant;
use App\Models\Niveau;

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

        $bulletins = Bulletin::where("apprenant_id", $apprenant->id)->get();
        return view('bulletins.index', compact('bulletins', 'apprenant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Apprenant $apprenant)
    {
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
        //
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
    public function update(Request $request, Bulletin $bulletin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bulletin $bulletin)
    {
        //
    }
}
