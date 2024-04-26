<?php

namespace App\Http\Controllers;

use App\Models\Contient;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContientController extends Controller
{
    public function afficherItemsInventaire($idUtilisateur)
{
    if (Auth::check()) {
        $utilisateurAuth = Auth::user();
        $accessToken = $utilisateurAuth->currentAccessToken();

        if ($accessToken && $accessToken->tokenable_id == $idUtilisateur) {
            $idInventaire = Utilisateur::where('idutilisateur', $idUtilisateur)->value('idinventaire');

            if ($idInventaire) {
                $contenus = Contient::with('item:iditem,item,image')->where('idinventaire', $idInventaire)->get();

                if ($contenus->isNotEmpty()) {
                    return response()->json($contenus);
                } else {
                    return response()->json(['message' => 'L\'inventaire est vide'], 404);
                }
            } else {
                return response()->json(['message' => 'L\'utilisateur n\'a pas d\'inventaire'], 404);
            }
        } else {
            return response()->json("Vous n'avez pas accès à cet inventaire", 403);
        }
    } else {
        return response()->json("Vous devez être connecté pour accéder à cette fonctionnalité", 401);
    }
}
public function achatItem(Request $request, $idUtilisateur)
{
    if (Auth::check()) {
        $utilisateurAuth = Auth::user();
        $accessToken = $utilisateurAuth->currentAccessToken();

        if ($accessToken && $accessToken->tokenable_id == $idUtilisateur) {
            $idInventaire = Utilisateur::where('idutilisateur', $idUtilisateur)->value('idinventaire');

            $contient = new Contient();
            $contient->idinventaire = $idInventaire;
            $contient->iditem = $request->iditem;
            $contient->save();

            return response()->json(['message' =>"Achat Effectué"]);
        } else {
            return response()->json(['message' =>"Vous n'êtes pas autorisé à effectuer cette action pour cet utilisateur"], 403);
        }
    } else {
        return response()->json(['message' =>"Vous devez être connecté pour accéder à cette fonctionnalité"], 401);
    }

}
}

