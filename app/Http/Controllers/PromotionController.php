<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Models\Apprenant;
use Illuminate\Validation\Rule;

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
            'est_active'=>"required",
            "date_limite"=>"required|date"
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
        $promotion->with('apprenants')->get();
        $apprenantsDisponibles = Apprenant::whereNull("promotion_id")->get();
        return view('promotions.show', compact('promotion', 'apprenantsDisponibles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        return view("promotions.edit", compact("promotion"));
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
                Rule::unique("promotions")->ignore($promotion->id),
            ],
            'annee_creation' => ['required', 'integer', 'min:1900'],
            "date_limite"=>"required",
            'est_active'=>"required"

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
    public function ajouterApprenant(Request $request, Promotion $promotion)
    {
        $request->validate([
            'apprenant_id' => 'required|integer|exists:apprenants,id',
        ]);

        $apprenant = Apprenant::find($request->apprenant_id);
        if (!$apprenant) {
            Message::error("cet apprenant n'existe pas");
        }
        if ($apprenant->promotion_id !== null) {
            Message::error("cet appartient deja a une promotion");
        }
        $apprenant->update([
            'promotion_id' => $promotion->id
        ]);

        $message = Message::success("apprenant a été a la  promotion  avec succès");
        return to_route('promotions.show', $promotion->id)->with($message->toMap());
    }
    public function retirerApprenant(Promotion $promotion, Apprenant $apprenant)
    {
        if ($apprenant->promotion_id !== $promotion->id) {
            Message::error(" Cet apprenant n'appartient pas à cette promotion");
        } else {
            $message = Message::success('Apprenant est retiré  avec succès !');
            $apprenant->update(['promotion_id' => null]);
            return to_route('promotions.show', $promotion->id)->with($message->toMap());
        }
    }
}
