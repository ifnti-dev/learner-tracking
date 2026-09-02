<?php

namespace App\Http\Controllers;

use App\Models\DocumentPedagogique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Message;
use App\Models\Niveau;

class DocumentPedagogiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $document_pedagogiques = DocumentPedagogique::with('niveau')->get();
        return view('document_pedagogiques.index', compact('document_pedagogiques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $niveaux=Niveau::all();
        return view('document_pedagogiques.create',compact('niveaux'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string',
            'auteur' => 'required|string',
            'quantite' => 'required|integer|min:1',
            'description' => 'nullable',
            'niveau_id' =>'required|exists:niveaux,id'
        ]);
        DocumentPedagogique::create($validated);
        $message = Message::success('Le document pédagogique a été enregistré avec succès.');
        return to_route('document-pedagogiques.index')->with($message->toMap());
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentPedagogique $documentPedagogique)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentPedagogique $documentPedagogique)
    {
         $niveaux=Niveau::all();
         return view('document_pedagogiques.edit',compact('documentPedagogique','niveaux'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentPedagogique $documentPedagogique)
    {
         $validated = $request->validate([
            'titre' => 'required|string',
            'auteur' => 'required|string',
            'quantite' => 'required|integer|min:1',
            'description' => 'nullable',
            'niveau_id' =>'required|exists:niveaux,id'
        ]);
        $documentPedagogique->update($validated);
        $message = Message::success('Le document pédagogique a été mis a jour avec succès.');
        return to_route('document-pedagogiques.index')->with($message->toMap());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentPedagogique $documentPedagogique)
    {
        $documentPedagogique->delete();
        $message = Message::success("le document  a été retiré  avec succès ");
        return to_route('document-pedagogiques.index')->with($message->toMap());
    }
}
