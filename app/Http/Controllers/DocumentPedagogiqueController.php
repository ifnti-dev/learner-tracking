<?php

namespace App\Http\Controllers;

use App\Models\DocumentPedagogique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentPedagogiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $document_pedagogiques = DocumentPedagogique::all();
        return view('document_pedagogiques.index',compact('document_pedagogiques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('document_pedagogiques.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         dd("store action");
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentPedagogique $documentPedagogique)
    {
        dd("show action");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentPedagogique $documentPedagogique)
    {
        dd("edit action");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentPedagogique $documentPedagogique)
    {
        dd("update action");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentPedagogique $documentPedagogique)
    {
        dd("destroy action");
    }
}
