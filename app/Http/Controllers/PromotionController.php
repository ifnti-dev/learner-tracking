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
        echo "create action";
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
    public function show(Promotion $promotion)
    {
        echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        echo "edit action";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
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
            $message = Message::error('Supprimer impossible');            
        }
        return to_route("promotions.index")->with($message->toMap());
    }
}
