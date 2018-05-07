<?php

namespace App\Http\Controllers;

use App\NiveauUtilisateur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Auth;


class NiveauUtilisateurController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    //fetch tous les niveaux
    public function index() {
         $niveaux = NiveauUtilisateur::all();
         return response()->json(["liste_niveau"=>$niveaux], 200);
    }
    //va chercher le niveau avec l'id correspondant
    public function getNiveau($id) {
         $niveau = NiveauUtilisateur::findOrFail($id);
         return response()->json(['niveau'=>$niveau], 200);
    }

    //crée un nouveau niveau
    public function saveNiveau(Request $request) {
         $this->validate($request, ["type" => 'required|unique:niveauutilisateur']);
         $niveau = NiveauUtilisateur::create($request->all());
          $niveau->save();
         return response()->json($niveau, 200);
    }

    //permet de modifier les informations d'un niveau
    public function updateNiveau(Request $request, $id) {
         $this->validate($request, ["type" => 'required']);
         $niveau = NiveauUtilisateur::findOrFail($id);
         $niveau->type = $request->input('type');
         $niveau->save();
         return response()->json($niveau, 200);
    }

    //suppr un niveau
    public function deleteNiveau($id) {
         $niveau = NiveauUtilisateur::findOrFail($id);
         $niveau->delete();
         return response()->json(['status' => 'Deleted'], 200);
    }
}
