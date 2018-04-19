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

    //fetch tous les utilisateurs, marche
    public function index() {
         $pays = Pays::all();
         return response()->json($pays);
    }
    
    //va chercher l'utilisateur avec l'id correspondant, marche
    public function getPays($country_code) {
         $utilisateur = Pays::find($country_code);
         return response()->json($utilisateur);
    }

    // //crée un nouvel utilisateur
    // public function saveUtilisateur(Request $request) {
    //      $utilisateur = Utilisateur::create($request->all());
    //      //hashage mdp
    //      $utilisateur->pass = Crypt::encrypt($utilisateur->pass);
    //      return response()->json('created');
    // }

    // //permet de modifier les informations d'un utilisateur
    // //fonctions différentes selon modif par admin ou user lambda ?
    // public function updateUtilisateur(Request $request, $id) {
    //      $utilisateur = Utilisateur::find($id);
    //      $utilisateur->pseudo = $request->input('pseudo');
    //      $utilisateur->mail = $request->input('mail');
    //      $utilisateur->pass = $request->input('pass');
    //      //hashage mdp
    //      $utilisateur->pass = Crypt::encrypt($utilisateur->pass);
    //      $utilisateur->save();
    //      return response()->json($utilisateur);
    // }

    // public function deleteUtilisateur($id) {
    //      $utilisateur = Utilisateur::find($id);
    //      $utilisateur->delete();
    //      return response()->json('deleted');
    // }
}
