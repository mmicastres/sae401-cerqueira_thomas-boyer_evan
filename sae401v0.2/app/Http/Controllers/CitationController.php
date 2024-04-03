<?php

namespace App\Http\Controllers;

use App\Models\Citation;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CitationController extends Controller
{
    function liste(){
        return response()->json(Citation::all());
    }
    function citationAleatoire(){
        return response()->json(Citation::inRandomOrder()->first());
    }

}
