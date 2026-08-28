<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Enums\Etat;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Message;
use Illuminate\Support\Carbon;
use App\Models\Absence;
use Illuminate\Support\Facades\DB;

class SeanceController extends Controller
{
    public function index()
    {
        $seances = Seance::with(['promotion', 'user'])
            ->orderBy("created_at", "desc")
            ->get();
        return view('seances.index', compact('seances'));
    }
    public function planifierSeance()
    {
        $promotions = Promotion::orderBy('nom')->get();
        return view('seances.planifier-seance', compact('promotions'));
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
        $message = Message::success('la seance est planifiée avec succès');
        $seance = Seance::create($validated);
        return to_route('seances.index')->with($message->toMap());
    }
    public function create(Seance $seance)
    {
        $message = Message::error(" La séance n'est pas encore terminée");
        if (!$this->peutCreerSeance($seance)) {
            return to_route('seances.index')->with($message->toMap());
        }
        if ($seance->promotion) {
            $apprenants = $seance->promotion->apprenants;
            return view('seances.create', compact('seance', 'apprenants'));
        } else {
            $apprenants = collect();
        }
    }
    public function store(Request $request, Seance $seance)
    {
        dd($request->all());
        
        $message = Message::error(" La séance n'est pas encore terminée");
        if (!$this->peutCreerSeance($seance)) {
            return to_route('seances.index')->with($message->toMap());
        }
        $request->validate([
            'absents'   => 'nullable|array',
            'absents.*' => 'exists:apprenants,id',
        ]);
        DB::transaction(function () use ($seance, $request) {

            $seance->update(['etat' => 'TERMINER']);
            if ($request->filled('absents')) {
                foreach ($request->absents as $apprenantId) {
                    Absence::create([
                        'seance_id'    => $seance->id,
                        'apprenant_id' => $apprenantId,
                    ]);
                }
            }
        });

        $message = Message::success('Séance créée avec succès');
        return to_route('seances.index')->with($message->toMap());
    }
    public function peutCreerSeance(Seance $seance): bool
    {
        $dateFin = Carbon::parse($seance->date . ' ' . $seance->heureFin);
        return now()->greaterThan($dateFin)
            && !in_array($seance->etat, ['TERMINER', 'ANNULER']);
    }
}
