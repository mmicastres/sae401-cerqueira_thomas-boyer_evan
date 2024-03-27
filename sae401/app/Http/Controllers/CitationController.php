<?php

namespace App\Http\Controllers;

use App\Models\Citation;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class CitationController extends Controller
{
    function liste(){
        return response()->json(Citation::all());
    }
    function citationAleatoire(){
        return response()->json(Citation::inRandomOrder()->first());
    }
    function achatDeCitation($idutilisateur){
        $utilisateur=Utilisateur::find($idutilisateur);
        $utilisateur->update(['pieces' => $utilisateur->pieces-3]);
        return response()->json($utilisateur);
    }
}
