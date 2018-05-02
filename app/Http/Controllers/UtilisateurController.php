<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Utilisateur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Auth;


class UtilisateurController extends Controller
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

    //fetch tous les utilisateurs
    public function index() {
         $utilisateurs = Utilisateur::all();
         return response()->json($utilisateurs, 200);
    }
    //va chercher l'utilisateur avec l'id correspondant
    public function getUtilisateur($id) {
         $utilisateur = Utilisateur::findOrFail($id);
         return response()->json($utilisateur, 200);
    }

    //crée un nouvel utilisateur
    public function saveUtilisateur(Request $request) {
         $this->validate($request, ["pseudo" => 'required|unique:utilisateur', "mail" => 'required|unique:utilisateur', "pass" => 'required']);
         $utilisateur = Utilisateur::create($request->all());
         $utilisateur->idNiveau = 1;
         $utilisateur->actif = 1;
           //hashage mdp
           $utilisateur->pass = Hash::make($utilisateur->pass);
           $utilisateur->save();
         return response()->json($utilisateur, 200);
    }

    //permet de modifier les informations d'un utilisateur
    public function updateUtilisateur(Request $request, $id) {
         $this->validate($request, ["pseudo" => 'required', "mail" => 'required', "pass" => 'required']);
         $utilisateur = Utilisateur::findOrFail($id);
         $utilisateur->pseudo = $request->input('pseudo');
         $utilisateur->mail = $request->input('mail');
         $utilisateur->pass = $request->input('pass');
         //hashage mdp
         $utilisateur->pass = Hash::make($utilisateur->pass);
         $utilisateur->save();
         return response()->json($utilisateur, 200);
    }

    //suppr un utilisateur
    public function deleteUtilisateur($id) {
         $utilisateur = Utilisateur::findOrFail($id);
         $utilisateur->delete();
         return response()->json(['status' => 'Deleted'], 200);
    }
}