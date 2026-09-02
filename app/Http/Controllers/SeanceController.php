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
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class SeanceController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:seance.planifier', only: ['planifierSeance', 'creer']),
            new Middleware('permission:seance.view', only: ['index', 'voirAbsents']),
            new Middleware('permission:seance.gerer.absence', only: ['mentionnerAbsents', 'enregistrerAbsents']),
            new Middleware('permission:seance.update', only: ['demarrer', 'annuler', 'terminer']),
        ];
    }

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
        return view('seances.planifier_seance', compact('promotions'));
    }

    public function creer(Request $request)
    {

        $validated = $request->validate([
            'intitule'      => 'required|string|max:255',
            'promotion_id'  => 'required|exists:promotions,id',
            'type_seance'   => 'required|in:PRESENTIEL,ENLIGNE',
            'date'          => 'required|date|after_or_equal:today',
            'heure_debut'   => 'required|date_format:H:i',
            'heure_fin'     => 'required|date_format:H:i|after:heure_debut',
            'lien_visio'    => 'nullable|required_if:type_seance,ENLIGNE|url',
            'description'   => 'nullable|string',
        ]);

        $chevauchement = Seance::where('promotion_id', $validated['promotion_id'])
            ->where('date', $validated['date'])
            ->where('etat', '!=', 'ANNULER')
            ->where(function ($query) use ($validated) {
                $query->where('heure_debut', '<', $validated['heure_fin'])
                    ->where('heure_fin', '>', $validated['heure_debut']);
            })->exists();
        if ($chevauchement) {
            $message = Message::error(
                'Impossible de planifier : une séance existe déjà pour cette promotion à cette date avec un horaire qui chevauche'
            );
            return back()->withInput()->with($message->toMap());
        }
        Seance::create([
            'intitule'     => $validated['intitule'],
            'promotion_id' => $validated['promotion_id'],
            'type_seance'  => $validated['type_seance'],
            'date'         => $validated['date'],
            'heure_debut'  => $validated['heure_debut'],
            'heure_fin'    => $validated['heure_fin'],
            'lien_visio'   => $validated['type_seance'] === 'ENLIGNE' ? $validated['lien_visio'] : null,
            'description'  => $validated['description'] ?? null,
            'etat'         => 'PLANIFIER',
            'user_id'      => Auth::user()->id
        ]);
        $message = Message::success('Séance planifiée avec succès');
        return to_route('seances.index')->with($message->toMap());
    }

    public function demarrer(Seance $seance)
    {
        if ($seance->etat !== 'PLANIFIER') {
            $message = Message::error('Seule une séance planifiée peut être démarrée.');
            return back()->with($message->toMap());
        }
        $seance->update(['etat' => 'ENCOURS']);

        $message = Message::success('Séance démarrée.');
        return back()->with($message->toMap());
    }

    public function annuler(Seance $seance)
    {
        if (!in_array($seance->etat, ['PLANIFIER'])) {
            $message = Message::error('Cette séance ne peut plus être annulée.');
            return back()->with($message->toMap());
        }

        $seance->update(['etat' => 'ANNULER']);
        $message = Message::success('Séance annulée.');
        return back()->with($message->toMap());
    }

    public function terminer(Seance $seance)
    {

        if ($seance->etat !== 'ENCOURS') {
            $message = Message::error('Seule une séance en cours peut être terminée.');
            return back()->with($message->toMap());
        }

        $maintenant = Carbon::now();
        $dateHeureFin = Carbon::parse($seance->date . ' ' . $seance->heure_fin);

        if ($maintenant < $dateHeureFin) {
            $message = Message::error("Impossible de terminer : heure de fin n'est pas encore terminer");
            return back()->with($message->toMap());
        }

        $seance->update(['etat' => 'TERMINER']);
        $message = Message::success('Séance terminée avec succès.');
        return back()->with($message->toMap());
    }

    public function mentionnerAbsents(Seance $seance)
    {
        if ($seance->etat !== 'TERMINER') {
            $message = Message::error('La séance doit être terminée avant de gérer les absents.');
            return back()->with($message->toMap());
        }
        $apprenants = $seance->promotion->apprenants;
        $absencesExistantes = Absence::where('seance_id', $seance->id)
            ->get();
        return view('seances.mentionner_absents', compact('seance', 'apprenants', 'absencesExistantes'));
    }

    public function enregistrerAbsents(Request $request, Seance $seance)
    {
        if ($seance->etat !== 'TERMINER') {
            $message = Message::error('La séance doit être terminée');
            return back()->with($message->toMap());
        }

        $validated = $request->validate([
            'absents' => 'nullable|array',
            'absents.*.apprenant_id' => 'required|exists:apprenants,id',
            'absents.*.est_justifie' => 'nullable|boolean',
            'absents.*.justification' => 'nullable|required_if:absents.*.est_justifie,1|string|max:500',
            'absents.*.absent'       => 'nullable|boolean',
        ]);
        Absence::where('seance_id', $seance->id)->delete();
        if (!empty($validated['absents'])) {
            foreach ($validated['absents'] as $absent) {
                if (empty($absent['absent'])) {
                    continue;
                }
                Absence::create([
                    'seance_id' => $seance->id,
                    'apprenant_id'   => $absent['apprenant_id'],
                    'est_justifie'  => $absent['est_justifie'] ?? false,
                    'justification' => $absent['justification'] ?? null,
                ]);
            }
        }
        $message = Message::success('Absences enregistrées avec succès.');
        return to_route('seances.index')->with($message->toMap());
    }
    public function voirAbsents(Seance $seance)
    {
        if ($seance->etat !== 'TERMINER') {
            $message = Message::error('La séance doit être terminée pour voir les absents.');
            return back()->with($message->toMap());
        }
        $absences = Absence::where('seance_id', $seance->id)
            ->with('apprenant')
            ->get()
            ->keyBy('apprenant_id');
            

        return view('seances.voir_absents', compact('seance', 'absences'));
    }
}

