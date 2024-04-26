<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavoriController extends Controller
{
    public function liste($idutilisateur)
    {
        if (Auth::check()) {
            $utilisateurAuth = Auth::user();
            $accessToken = $utilisateurAuth->currentAccessToken();

            if ($accessToken && $accessToken->tokenable_id == $idutilisateur) {
                $favoris = Favori::with('citation:citation,idcitation')->where('idutilisateur', $idutilisateur)->get();
                return response()->json($favoris);
            } else {
                return response("Vous n'êtes pas autorisé à accéder à ces données", 403);
            }
        } else {
            return response("Vous devez être connecté pour accéder à cette fonctionnalité", 401);
        }
    }

    public function ajouter(Request $request)
    {
        if (Auth::check()) {
            $favoris = new Favori();
            $favoris->idutilisateur = $request->idutilisateur;
            $favoris->idcitation = $request->idcitation;
            $favoris->save();
            return response()->json($favoris);
        } else {
            return response("Vous devez être connecté pour accéder à cette fonctionnalité", 401);
        }
    }

    public function supprimer(Request $request, $idutilisateur)
    {
        if (Auth::check()) {
            $utilisateurAuth = Auth::user();
            $accessToken = $utilisateurAuth->currentAccessToken();

            if ($accessToken && $accessToken->tokenable_id == $idutilisateur) {
                $favoris = Favori::where('idutilisateur', $idutilisateur)
                    ->where('idcitation', $request->idcitation)
                    ->first();

                if ($favoris) {
                    $favoris->delete();
                    return response()->json("Retiré des favoris avec succès");
                } else {
                    return response()->json("Enregistrement introuvable", 404);
                }
            } else {
                return response("Vous n'êtes pas autorisé à effectuer cette action pour cet utilisateur", 403);
            }
        } else {
            return response("Vous devez être connecté pour accéder à cette fonctionnalité", 401);
        }
    }
}
