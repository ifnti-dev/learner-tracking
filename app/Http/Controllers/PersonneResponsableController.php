<?php

namespace App\Http\Controllers;

use App\Models\PersonneResponsable;
use Illuminate\Http\Request;
use App\Http\Requests\Message;

class PersonneResponsableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personneResponsables = PersonneResponsable::all();
        return view('personne-responsables.index', compact('personneResponsables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(PersonneResponsable $personneResponsable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PersonneResponsable $personneResponsable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PersonneResponsable $personneResponsable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonneResponsable $personneResponsable)
    {
        $message = null;
        if ($personneResponsable->apprenants->count() == 0) {
            $personneResponsable->delete();
            $message = Message::success('Le tuteur a été supprimé avec succès');
        } else {
            $message = Message::error('Impossible de supprimer le tuteur car il est associé à des apprenants.');            
        }
        return to_route("personne-responsables.index")->with($message->toMap());
    }
}
