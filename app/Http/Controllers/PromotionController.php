<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Models\Apprenant;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::withCount('apprenants')->get();
        return view("promotions.index", compact("promotions"));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("promotions.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'nom'   => ['required', 'string', 'max:255', 'unique:promotions,nom'],
            'annee_creation' => ['required', 'integer', 'min:1900'],
        ]);

        $message = Message::success('la promotion est enregistrée avec succès');
        Promotion::create($validated);
        return to_route('promotions.index')->with($message->toMap());
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        $promotion->load('apprenants');
        return view('promotions.show', compact('promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        return view("promotions.edit",compact("promotion"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'nom' => [
                'required',
                'string',
                'max:255',
                'unique:promotions,nom,' . $promotion->id
            ],
            'annee_creation' => ['required', 'integer', 'min:1900'],
        ]);
        $promotion->update($validated);
        $message = Message::success('La promotion a été modifiée avec succès');
        return to_route('promotions.index')->with($message->toMap());
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        $message = null;
        if ($promotion->apprenants->count() == 0) {
            $promotion->delete();
            $message = Message::success('Supprimer avec success');
        } else {
            $message = Message::error('Suppression impossible car la promotion contenant des apprenants');
        }
        return to_route("promotions.index")->with($message->toMap());
    }
}
