<?php

namespace App\Http\Controllers;

use App\Cast;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Auth;


class CastController extends Controller
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

    //fetch tous les cast
    public function index() {
         $casts = Cast::all();
         return response()->json($casts, 200);
    }
    //va chercher le cast avec l'id correspondant
    public function getCast($id) {
         $cast = Cast::findOrFail($id);
         return response()->json($cast, 200);
    }

    //crée un nouveau cast
    public function saveCast(Request $request) {
          $this->validate($request, ["nom" => 'required', "prenom" => 'required', "illustration" => 'required']);
         $cast = Cast::create($request->all());
         $cast->save();
         return response()->json($cast, 200);
    }

    //permet de modifier les informations d'un cast
    public function updateCast(Request $request, $id) {
         $this->validate($request, ["nom" => 'required', "prenom" => 'required', "illustration" => 'required']);
         $cast = Cast::findOrFail($id);
         $cast->nom = $request->input('nom');
         $cast->prenom = $request->input('prenom');
         $cast->illustration = $request->input('illustration');
         $cast->dateNaissance = $request->input('dateNaissance');
         $cast->dateMort = $request->input('dateMort');
         $cast->save();
         return response()->json($cast, 200);
    }

    public function deleteCast($id) {
         $cast = Cast::findOrFail($id);
         $cast->delete();
         return response()->json(['status' => 'Deleted'], 200);
    }
}
