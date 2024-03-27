<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendController extends Controller
{
    function shop(){
        $article = Vend::with('item:iditem,item')->where('idmagasin',1)->get();

        
        if ($article->isNotEmpty()) {
            
            return response()->json($article);
        } else {
            
            return response()->json(['message' => 'Le magasin est vide'], 404);
        }
    }
}
