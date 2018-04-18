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

    //fetch tous les utilisateurs, marche
    public function index() {
         $utilisateurs = Utilisateur::all();
         return response()->json($utilisateurs);
    }
    //va chercher l'utilisateur avec l'id correspondant, marche
    public function getUtilisateur($id) {
         $utilisateur = Utilisateur::find($id);
         return response()->json($utilisateur);
    }

    //crée un nouvel utilisateur
    public function saveUtilisateur(Request $request) {
         $utilisateur = Utilisateur::create($request->all());
         //hashage mdp
         $utilisateur->pass = Crypt::encrypt($utilisateur->pass);
         return response()->json('created');
    }

    //permet de modifier les informations d'un utilisateur
    //fonctions différentes selon modif par admin ou user lambda ?
    public function updateUtilisateur(Request $request, $id) {
         $utilisateur = Utilisateur::find($id);
         $utilisateur->pseudo = $request->input('pseudo');
         $utilisateur->mail = $request->input('mail');
         $utilisateur->pass = $request->input('pass');
         //hashage mdp
         $utilisateur->pass = Crypt::encrypt($utilisateur->pass);
         $utilisateur->save();
         return response()->json($utilisateur);
    }

    public function deleteUtilisateur($id) {
         $utilisateur = Utilisateur::find($id);
         $utilisateur->delete();
         return response()->json('deleted');
    }
}
