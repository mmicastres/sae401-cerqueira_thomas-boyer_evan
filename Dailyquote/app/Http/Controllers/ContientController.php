<?php

namespace App\Http\Controllers;

use App\Models\Contient;
use Illuminate\Http\Request;


class ContientController extends Controller
{


    function afficherItemsInventaire($idInventaire)
    {
        
        $contenus = Contient::with('item:iditem,item,image')->where('idinventaire', $idInventaire)->get();

        
        if ($contenus->isNotEmpty()) {
            
            return response()->json($contenus);
        } else {
            
            return response()->json(['message' => 'L\'inventaire est vide'], 404);
        }
    }
}
