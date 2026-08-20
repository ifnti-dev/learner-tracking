<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidatController extends Controller
{
    public function inscription() {

        return view('candidats.inscription');
    }

    public function store(Request $request){
        dd($request->all());
    }
}
