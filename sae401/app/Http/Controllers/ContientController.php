<?php

namespace App\Http\Controllers;

use App\Models\Contient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ContientController extends Controller
{


    public function afficherItemsInventaire($idInventaire)
    {
        if (Auth::check()) {
            $utilisateurAuth = Auth::user();

            if ($utilisateurAuth->idInventaire === $idInventaire) {
                $contenus = Contient::with('item:iditem,item')->where('idinventaire', $idInventaire)->get();

                if ($contenus->isNotEmpty()) {
                    return response()->json($contenus);
                } else {
                    return response()->json(['message' => 'L\'inventaire est vide'], 404);
                }
            } else {
                return response("Vous n'avez pas accès à cet inventaire", 403);
            }
        } else {
            return response("Vous devez être connecté pour accéder à cette fonctionnalité", 401);
        }
    }
}
