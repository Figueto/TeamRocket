<?php

namespace App\Http\Controllers;

use App\Cast;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
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
        $this->middleware('auth',['except' => ['index','getCast']]);
        $this->middleware('admin',['except' => ['index','getCast']]);
    }

    //fetch tous les cast
    public function index() {
         $casts = Cast::all();
         return response()->json(["liste_cast"=>$casts], 200);
    }
    //va chercher le cast avec l'id correspondant
    public function getCast($id) {
         $cast = Cast::findOrFail($id);
         return response()->json(["liste_cast"=>$cast], 200);
    }

    //crée un nouveau cast
    public function saveCast(Request $request) {
          $this->validate($request, ["nom" => 'required', "prenom" => 'required', "illustration" => 'required']);
         $cast = Cast::create($request->all());
         $cast->save();
         LogController::save($request,1,2,$cast->idCast);
         return response()->json(["cast"=>$cast], 200);
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
         LogController::save($request,3,2,$id);
         return response()->json(["cast"=>$cast], 200);
    }

    public function deleteCast($id) {
         $cast = Cast::findOrFail($id);
         $cast->delete();
         LogController::save($request,2,2,$id);
         return response()->json(['status' => 'Deleted'], 200);
    }
}
