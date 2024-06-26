<?php

namespace App\Http\Controllers;
use App\Models\Vend;
use Illuminate\Http\Request;

class VendController extends Controller
{
    function magasinItem(){
        $articles = Vend::with('item:iditem,item,prix,image')->where('idmagasin', 1)->get();
         
        if ($articles->isNotEmpty()) {
            
            return response()->json($articles);
        } else {
            
            return response()->json(['message' => 'Le magasin est vide'], 404);
        }
    }
}
