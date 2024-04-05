<?php

use App\Http\Controllers\InventaireController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitationController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\ContientController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\VendController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route Citation

Route::get('/citation', [CitationController::class, 'liste']);

Route::get('/citation/aleatoire', [CitationController::class, 'citationAleatoire']);


//Route Utilisateur

Route::post('/utilisateurs',[UtilisateurController::class, 'creerUtilisateur']);
Route::post('/login',[UtilisateurController::class, 'authentifierUtilisateur']);
Route::put('/utilisateurs/{idutilisateur}', [UtilisateurController::class,'majUtilisateur']);
Route::middleware(['auth:sanctum'])->delete('/tokens/{idutilisateur}', [UtilisateurController::class,'deconnexion']);

Route::middleware(['auth:sanctum'])->put('/pieces/{idutilisateur}', [UtilisateurController::class,'piecesEnMoins']);
Route::middleware(['auth:sanctum'])->get('/pieces/{idutilisateur}', [UtilisateurController::class,'pieces']);


/*Inventaire personnel de l'utilisateur ( bien mettre l'id de son inventaire et non pas celui de l'utilisateur connecté)*/
Route::/*middleware(['auth:sanctum'])->*/get("/inventaire/{idinventaire}", [ContientController::class, 'afficherItemsInventaire']);


Route::middleware(['auth:sanctum'])->get('/favoris/{idutilisateur}',[FavoriController::class, 'liste']);
Route::middleware(['auth:sanctum'])->post('/favoris',[FavoriController::class, 'ajouter']);
Route::middleware(['auth:sanctum'])->delete('/favoris/{idutilisateur}',[FavoriController::class, 'supprimer']);


Route::/*middleware(['auth:sanctum'])->*/get('/magasin', [VendController::class,'magasinItem']);



/*A finir*/ 