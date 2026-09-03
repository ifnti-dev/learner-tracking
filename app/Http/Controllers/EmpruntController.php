<?php

namespace App\Http\Controllers;

use App\Models\Apprenant;
use App\Models\DocumentPedagogique;
use App\Models\DocumentPedagogiqueEmprunt;
use App\Models\Emprunt;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Emprunt  $emprunt)
    {

    $emprunts = DB::table('emprunts')
    ->join('apprenants', 'apprenants.id', '=', 'emprunts.apprenant_id')
    ->join('document_pedagogique_emprunts', 'document_pedagogique_emprunts.emprunt_id', '=', 'emprunts.id')
    ->join('document_pedagogiques', 'document_pedagogiques.id', '=', 'document_pedagogique_emprunts.document_pedagogique_id')
    ->join('niveaux', 'niveaux.id', '=', 'document_pedagogiques.niveau_id') 
    ->select([
        'emprunts.id as id',
        'emprunts.apprenant_id as apprenant_id',
        'apprenants.nom',
        'apprenants.prenom',
        'emprunts.date',
        'emprunts.date_restitution',
        'document_pedagogiques.titre',
        'document_pedagogiques.quantite',
        'niveaux.nom as niveau_nom'
    ])
    ->get();

    return view('emprunts.index', compact('emprunts'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apprenants=Apprenant::all();
        $document_pedagogiques=DocumentPedagogique::all();
        $niveaux=Niveau::all();
        return view('emprunts.create',compact('apprenants','document_pedagogiques','niveaux'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Emprunt $emprunt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emprunt $emprunt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Emprunt $emprunt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emprunt $emprunt)
    {
        //
    }
}
