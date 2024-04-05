<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use Illuminate\Http\Request;


class FavoriController extends Controller
{
    function liste($idutilisateur)
    {
        $favoris = Favori::with('citation:citation,idcitation')->where('idutilisateur', $idutilisateur)->get();
        return response()->json($favoris);
    }
    function ajouter(Request $request)
    {
        $favoris = new Favori();
        $favoris->idutilisateur = $request->idutilisateur;
        $favoris->idcitation = $request->idcitation;
        $favoris->save();
        return response()->json($favoris);
    }

    function supprimer(request $request, $idutilisateur)
    {
        $favoris = Favori::where('idutilisateur', $idutilisateur)
            ->where('idcitation', $request->idcitation)
            ->first();

        if ($favoris) {
            $favoris->delete();
            return response()->json("Retiré des favoris avec succès");
        } else {
            return response()->json("Enregistrement introuvable", 404);
        }
    }
    
}
