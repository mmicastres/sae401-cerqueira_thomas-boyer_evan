<?php

use App\Http\Controllers\InventaireController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitationController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\ContientController;



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

/*Route::get('/utilisateurs', [UtilisateurController::class, 'liste']);*/
Route::post('/utilisateurs',[UtilisateurController::class, 'creerUtilisateur']);
Route::middleware(['auth:sanctum'])->get('/utilisateurs',[UtilisateurController::class, 'liste']);
/*Route::middleware(['auth:sanctum'])->get('/utilisateurs', function (Request $request) {

});*/

Route::get("/inventaire/{idinventaire}", [ContientController::class, 'afficherItemsInventaire']);

Route::post('/login',[UtilisateurController::class, 'authentifierUtilisateur']);
