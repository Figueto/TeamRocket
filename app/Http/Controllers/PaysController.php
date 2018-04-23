<?php

namespace App\Http\Controllers;

use App\Pays;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Auth;


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
         return $pays;
    }

    //crée un nouvel pays
    public function savePays(Request $request) {
        $this->validate($request,["idPays"=>'required|alpha|size:2']);
        $this->validate($request,["nom"=>'required']);
        try{
            $pays = new Pays($request->all());
            $pays->save();
        }catch(QueryException $e ){
            return ["info"=>"Duplicate key"];
        }
        return $this->getPays($request->input("idPays"));
    }


    //permet de modifier les informations d'un pays
    public function updatePays(Request $request, $country_code) {
        $this->validate($request,["nom"=>'required']);
        
        $pays = pays::findOrFail($country_code);
        $pays->nom = $request->input('nom');
        $pays->save();
        return $pays;
    }

    public function deletePays($country_code) {
         $pays = pays::findOrFail($country_code);
         $pays->delete();
         return ['info'=>'Deleted'];
    }
}
