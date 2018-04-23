<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use App\Utilisateur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UtilisateurController extends Controller
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

    //fetch tous les utilisateurs
    public function index() {
         $utilisateurs = Utilisateur::all();
         return response()->json($utilisateurs);
    }
    //va chercher l'utilisateur avec l'id correspondant
    public function getUtilisateur($id) {
         $utilisateur = Utilisateur::findOrFail($id);
         return response()->json($utilisateur);
    }

    //crée un nouvel utilisateur
    public function saveUtilisateur(Request $request) {
         $utilisateur = Utilisateur::create($request->all());
         $utilisateur->idNiveau = 1;
         $utilisateur->actif = 1;
         $utilisateur->hasRequiredAttribute(); //Throws exceptions if doesnt have needed attribute
         //hashage mdp
         $utilisateur->pass = Crypt::encrypt($utilisateur->pass);
         $utilisateur->save();
         return response()->json($utilisateur);
    }

    //permet de modifier les informations d'un utilisateur
    public function updateUtilisateur(Request $request, $id) {
         $utilisateur = Utilisateur::findOrFail($id);
         $utilisateur->pseudo = $request->input('pseudo');
         $utilisateur->mail = $request->input('mail');
         $utilisateur->pass = $request->input('pass');
         $utilisateur->hasRequiredAttribute();
         //hashage mdp
         $utilisateur->pass = Crypt::encrypt($utilisateur->pass);
         $utilisateur->save();
         return response()->json($utilisateur);
    }

    //suppr un utilisateur
    public function deleteUtilisateur($id) {
         $utilisateur = Utilisateur::findOrFail($id);
         $utilisateur->delete();
         return response()->json('deleted');
    }
}
