<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Inventaire;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use PhpParser\Node\NullableType;

class UtilisateurController extends Controller
{
    function creerUtilisateur(Request $request,)
    {
        if (Utilisateur::query()->where('email', $request->email)->first()) {
            return response("Adresse e-mail déjà utilisée", 400);
        } elseif ($request->motdepasse == null) {
            return response("Veuillez entrer un mot de passe", 400);
        } elseif (strlen($request->motdepasse) < 8) {
            return response("Le mot de passe doit contenir au moins 8 caractères", 400);
        } else {

            $inventaire = new Inventaire();

            $inventaire->save();

            $utilisateur = new Utilisateur();
            $utilisateur->idinventaire = $inventaire->idinventaire;
            $utilisateur->nom = $request->nom;
            $utilisateur->prenom = $request->prenom;
            $utilisateur->email = $request->email;
            $utilisateur->motdepasse = password_hash($request->motdepasse, PASSWORD_BCRYPT);
            $utilisateur->pieces = 20;
            $utilisateur->save();
            return response()->json($utilisateur);
        }
    }
    function authentifierUtilisateur(LoginRequest $request)
    {
        if (Utilisateur::query()->where('email', $request->email)->first() == null) {
            return response("Adresse e-mail introuvable", 400);
        } else {
            $utilisateur = Utilisateur::query()->where('email', $request->email)->first();
            if ($utilisateur && password_verify($request->motdepasse, $utilisateur->motdepasse)) {
                $tokenResult = $utilisateur->createToken('Personal Access Token');
                $token = $tokenResult->plainTextToken;
                return response()->json([
                    'utilisateur' => $utilisateur, 'status' => 1,
                    'accessToken' => $token,
                    'token_type' => 'Bearer'
                ]);
            } else {
                return response("mot de passe incorrect", 400);
            }
        }
    }
    function liste()
    {
        return response()->json(Utilisateur::find(36));
    }
    function piecesEnMoins(Request $request, $idutilisateur)
    {
        $utilisateur = Utilisateur::find($idutilisateur);
        if ($utilisateur->pieces - $request->pieces < 0) {
            return response("Vous n'avez pas assez de pieces", 400);
        } else {
            $utilisateur->pieces = $utilisateur->pieces - $request->pieces;
            $utilisateur->save();
            return response()->json($utilisateur);
        }
    }
    function pieces($idutilisateur)
    {
        $utilisateur = Utilisateur::find($idutilisateur);
        return response()->json($utilisateur->pieces);
    }
    function deconnexion($idutilisateur)
    {
        $jetons = PersonalAccessToken::where('tokenable_id', $idutilisateur)->get();


        foreach ($jetons as $jeton) {
            $jeton->delete();
        }


        return response()->json("Déconnexion réussie");
    }
    function majUtilisateur(Request $request, $idutilisateur)
    {
        if ($request->all() == null) {
            return response("Veuillez saisir au moins un champ", 400);
        } else {
            $utilisateur = Utilisateur::find($idutilisateur);

            if ($utilisateur == null) {
                return response("Utilisateur introuvable", 400);
            } else {
                if ($request->motdepasse != null) {
                    if (strlen($request->motdepasse) < 8) {
                        return response("Le nouveau mot de passe doit contenir au moins 8 caractères", 400);
                    } elseif (password_verify($request->motdepasse, $utilisateur->motdepasse)) {
                        return response("Veuillez entrer un nouveau mot de passe", 400);
                    } else {
                        $utilisateur->motdepasse = password_hash($request->motdepasse, PASSWORD_BCRYPT);
                    }
                }
                if ($request->nom != null) {
                    $utilisateur->nom = $request->nom;
                }
                if ($request->prenom != null) {
                    $utilisateur->prenom = $request->prenom;
                }
                if ($request->email != null) {
                    $utilisateur->email = $request->email;
                }
                $utilisateur->save();
                return response()->json($utilisateur);
            }
        }
    }
}
