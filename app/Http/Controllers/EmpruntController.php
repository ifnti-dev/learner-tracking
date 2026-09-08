<?php

namespace App\Http\Controllers;

use App\Models\Apprenant;
use App\Models\DocumentPedagogique;
use App\Models\DocumentPedagogiqueEmprunt;
use App\Models\Emprunt;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Requests\Message;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class EmpruntController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:emprunt.view', only: ['index', 'show']),
            new Middleware('permission:emprunt.create', only: ['create', 'store']),
            new Middleware('permission:emprunt.update', only: ['edit', 'update']),
            new Middleware('permission:emprunt.destroy', only: ['destroy']),
            new Middleware('permission:emprunt.restituer', only: ['restituer']),
        ];
    }

    public function index(Emprunt  $emprunt)
    {

        $emprunts = DB::table('emprunts')
            ->leftJoin('apprenants', 'apprenants.id', '=', 'emprunts.apprenant_id')
            ->join('document_pedagogique_emprunts', 'document_pedagogique_emprunts.emprunt_id', '=', 'emprunts.id')
            ->join('document_pedagogiques', 'document_pedagogiques.id', '=', 'document_pedagogique_emprunts.document_pedagogique_id')
            ->join('niveaux', 'niveaux.id', '=', 'document_pedagogiques.niveau_id')
            ->select([
                'emprunts.id as id',
                'emprunts.apprenant_id as apprenant_id',
                'apprenants.nom',
                'apprenants.prenom',
                'emprunts.date_emprunt',
                'emprunts.date_restitution',
                'emprunts.date_restitution_prevue',
                'emprunts.est_restitue',
                'document_pedagogiques.titre',
                'niveaux.nom as niveau_nom'
            ])
            ->orderBy('emprunts.id', 'desc')
            ->get();
        return view('emprunts.index', compact('emprunts'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apprenants = Apprenant::all();
        $document_pedagogiques = DocumentPedagogique::all();
        return view('emprunts.create', compact('apprenants', 'document_pedagogiques'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'document_id' => 'required|exists:document_pedagogiques,id',
            'apprenant_id' => 'required|exists:apprenants,id',
            'date_restitution_prevue' => 'required|date|after:today',
        ]);

        $apprenantId = $validated['apprenant_id'];
        $documentId = $validated['document_id'];

        $documentDemande = DocumentPedagogique::findOrFail($documentId);

        if ($documentDemande->quantite <= 0) {
            $message = Message::error("les documents ne sont pas disponibles pour l'instant.");
            return back()->withInput()->with($message->toMap());
        }

        $dejaMemeDoc = Emprunt::where('apprenant_id', $apprenantId)
            ->where('est_restitue', false)
            ->whereHas('document_pedagogiques', function ($q) use ($documentId) {
                $q->where('document_pedagogiques.id', $documentId);
            })
            ->exists();

        if ($dejaMemeDoc) {
            $message = Message::error("Cet apprenant possède déjà ce document sans l'avoir restitué !");
            return back()->withInput()->with($message->toMap());
        }

        $dejaMemeNiveauEtTitre = Emprunt::where('apprenant_id', $apprenantId)
            ->where('est_restitue', false)
            ->whereHas('document_pedagogiques', function ($q) use ($documentDemande) {
                $q->where('niveau_id', $documentDemande->niveau_id)
                    ->where('titre', $documentDemande->titre);
            })
            ->exists();

        if ($dejaMemeNiveauEtTitre) {
            $message = Message::error("Cet apprenant a déjà un document de même titre et de même niveau en cours d'emprunt ");
            return back()->withInput()->with($message->toMap());
        }

        $emprunt = Emprunt::create([
            'date_emprunt' => Carbon::now()->toDateString(),
            'date_restitution_prevue' => $validated['date_restitution_prevue'],
            'date_restitution' => null,
            'est_restitue' => false,
            'apprenant_id' => $apprenantId,
        ]);

        DocumentPedagogiqueEmprunt::create([
            'emprunt_id' => $emprunt->id,
            'document_pedagogique_id' => $documentId,
        ]);

        $documentDemande->decrement('quantite');

        $message = Message::success("L'emprunt a été enregistré avec succès ");
        return to_route('emprunts.index')->with($message->toMap());
    }



    /**
     * Display the specified resource.
     */
    public function show(Emprunt $emprunt)
    {
        $emprunt->with(['apprenant', 'document_pedagogiques'])->get();
        return view('emprunts.show', compact('emprunt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emprunt $emprunt)
    {
        $apprenants = Apprenant::all();
        $document_pedagogiques = DocumentPedagogique::all();

        $documentAttache = DB::table('document_pedagogique_emprunts')
            ->where('emprunt_id', $emprunt->id)
            ->first();

        return view('emprunts.edit', compact('emprunt', 'apprenants', 'document_pedagogiques', 'documentAttache'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Emprunt $emprunt)
    {
        $validated = $request->validate([
            'document_id' => 'required|exists:document_pedagogiques,id',
            'apprenant_id' => 'required|exists:apprenants,id',
            'date_restitution_prevue' => 'required|date|after:today',
        ]);

        $emprunt->update([
            'apprenant_id' => $validated['apprenant_id'],
            'date_restitution_prevue' => $validated['date_restitution_prevue'],

        ]);

        DB::table('document_pedagogique_emprunts')
            ->where('emprunt_id', $emprunt->id)
            ->update([
                'document_pedagogique_id' => $validated['document_id'],
            ]);
        $message = Message::success("L'emprunt a été mise à jour avec succès !");
        return to_route('emprunts.index')->with($message->toMap());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emprunt $emprunt)
    {
        DB::table('document_pedagogique_emprunts')->where('emprunt_id', $emprunt->id)->delete();
        $emprunt->delete();
        $message = Message::success('emprunt pour cet apprenant est supprimé  avec succès !');
        return to_route('emprunts.index')->with($message->toMap());
    }
    public function restituer(Emprunt $emprunt)
    {
        if ($emprunt->est_restitue) {
            $message = Message::error("Cet emprunt a déjà été restitué.");
            return back()->with($message->toMap());
        }

        $emprunt->update([
            'est_restitue' => true,
            'date_restitution' => Carbon::now()->toDateString(),
        ]);

        foreach ($emprunt->document_pedagogiques as $document) {
            $document->increment('quantite');
        }

        $message = Message::success("Le document a été restitué avec succès !");
        return to_route('emprunts.index')->with($message->toMap());
    }
}
