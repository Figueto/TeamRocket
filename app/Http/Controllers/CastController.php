<?php

namespace App\Http\Controllers;

use App\Cast;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


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
         return response()->json($casts);
    }
    //va chercher le cast avec l'id correspondant
    public function getCast($id) {
         $cast = Cast::find($id);
         return response()->json($cast);
    }

    //crée un nouveau cast
    public function saveCast(Request $request) {
         $cast = Cast::create($request->all());
         return response()->json('created');
    }

    //permet de modifier les informations d'un cast
    public function updateCast(Request $request, $id) {
         $cast = Cast::find($id);
         $cast->nom = $request->input('nom');
         $cast->prenom = $request->input('prenom');
         $cast->illustration = $request->input('illustration');
         $cast->dateNaissance = $request->input('dateMort');
          $cast->dateMort = $request->input('dateNaissance');
         $cast->save();
         return response()->json($cast);
    }

    public function deleteCast($id) {
         $cast = Cast::find($id);
         $cast->delete();
         return response()->json('deleted');
    }
}
