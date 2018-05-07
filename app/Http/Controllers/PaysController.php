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
         $this->middleware('auth',['except' => ['index','getPays']]);
        $this->middleware('admin',['except' => ['index','getPays']]);
    }

    //fetch tous les pays, marche
    public function index() {
         $pays = Pays::all();
         return response()->json(["liste_pays" => $pays],200);
    }

    //va chercher l'pays avec l'id correspondant, marche
    public function getPays($country_code) {
        $pays = Pays::findOrFail($country_code);
         return response()->json(["liste_pays" => $pays],200);
    }

    //crée un nouvel pays
    public function savePays(Request $request) {
        $this->validate($request,["idPays"=>'required|alpha|size:2']);
        $this->validate($request,["nom"=>'required']);
        try{
            $pays = new Pays($request->all());
            $pays->save();
        }catch(QueryException $e ){
            return response()->json(["status"=>"Duplicate key"],409);
        }
        return response()->json(["pays" => $this->getPays($request->input("idPays"))]);
    }


    //permet de modifier les informations d'un pays
    public function updatePays(Request $request, $country_code) {
        $this->validate($request,["nom"=>'required']);

        $pays = pays::findOrFail($country_code);
        $pays->nom = $request->input('nom');
        $pays->save();
        return response()->json(["pays" => $pays],200);
    }

    public function deletePays($country_code) {
         $pays = pays::findOrFail($country_code);
         $pays->delete();
         return response()->json(['status'=>'Deleted'],200);
    }
}
