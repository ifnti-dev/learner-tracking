<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Enums\Etat;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Message;

class SeanceController extends Controller
{
    public function index()
    {
        $seances = Seance::with(['promotion', 'user'])
            ->orderBy("created_at", "desc")
            ->get();
        return view('seances.index', compact('seances'));
    }
    public function create()
    {
        $promotions = Promotion::orderBy('nom')->get();
        return view('seances.create', compact('promotions'));
    }
    public function planifier(Request $request)
    {

        $validated = $request->validate([
            'intitule'     => 'required|string|max:255',
            'description'  => 'nullable|string',
            'heure_debut'  => 'required',
            'heure_fin'    => 'required|after:heure_debut',
            'date'         => 'required|date',
            'type_seance'  => 'required|string',
            'promotion_id' => 'required|exists:promotions,id',
        ]);

        $validated['etat'] = Etat::PLANIFIER;
        $validated['user_id'] = Auth::id();
        $message = Message::success('la promotion est enregistrée avec succès');
        $seance = Seance::create($validated);
        return to_route('seances.index')->with($message->toMap());
    }
}
