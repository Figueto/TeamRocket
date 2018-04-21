<?php

namespace App\Http\Controllers;

use App\Pays;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PaysController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //fetch tous les pays, marche
    public function index() {
         $pays = Pays::all();
         return response()->json($pays);
    }
    
    //va chercher l'pays avec l'id correspondant, marche
    public function getPays($country_code) {
         $pays = Pays::findOrFail($country_code);
         return response()->json($pays);
    }

    //crée un nouvel pays
    public function savePays(Request $request) {
        var_dump($request->all());
        $pays = new Pays($request->all());
        $pays->hasRequiredAttribute(); //Throws exceptions if doesnt have needed attribute
        $pays->save();
        return response()->json('created');
    }


    //permet de modifier les informations d'un pays
    public function updatePays(Request $request, $country_code) {
        $pays = pays::findOrFail($country_code);
        $pays->nom = $request->input('nom');
        $pays->hasRequiredAttribute();
        $pays->save();
        return response()->json($pays);
    }

    public function deletePays($country_code) {
         $pays = pays::findOrFail($country_code);
         $pays->delete();
         return response()->json('deleted');
    }
}
