<?php

namespace App\Http\Controllers;

use App\Models\Citation;

use Illuminate\Http\Request;


class CitationController extends Controller
{
    function liste(){
        return response()->json(Citation::all());
    }
    function citationAleatoire(){
        return response()->json(Citation::inRandomOrder()->first());
    }

}
