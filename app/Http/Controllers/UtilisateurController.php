<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use App\Utilisateur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    $this->middleware('auth', ['except' => ['saveUtilisateur']]);
        $this->middleware('admin', ['except' => ['saveUtilisateur', 'updateUtilisateur']]);
    }

    //fetch tous les utilisateurs
    public function index() {
         $utilisateurs = Utilisateur::all();
         return response()->json(["liste_utilisateur" => $utilisateurs], 200);
    }
    //va chercher l'utilisateur avec l'id correspondant
    public function getUtilisateur($id) {
         $utilisateur = Utilisateur::findOrFail($id);
         $utilisateur->nivUtilisateur = DB::table('niveauutilisateur')
         ->where('idNiveau', $utilisateur->idNiveau)
         ->value('type');
         return response()->json(["utilisateur" => $utilisateur], 200);
    }

    //crée un nouvel utilisateur
    //utilisable seulement par un user non connecté
    public function saveUtilisateur(Request $request) {
         $this->validate($request,
         ["pseudo" => 'required|unique:utilisateur',
         "mail" => 'required|unique:utilisateur',
         "pass" => 'required',
          "idNiveau" =>'required']);
          //fonctionne pas. me laisse pas utiliser auth vu que j'ai exclu cette fonction du middleware 'auth' dans le construct
          /*$idUtilisateur = $request->auth->idUtilisateur;
          echo $idUtilisateur;
          //si user existe (connecté), stop
          if($request->auth != null) {
               abort(401, 'Vous êtes déjà connecté');
          }*/
         $utilisateur = Utilisateur::create($request->all());
         $utilisateur->actif = 1;
         $utilisateur->idNiveau = $request->input('idNiveau');
           //hashage mdp
           $utilisateur->pass = Crypt::encrypt($utilisateur->pass);
           $utilisateur->save();
         return response()->json(["utilisateur"=>$utilisateur], 200);
    }

    //permet de modifier les informations d'un utilisateur
    //si admin peut update n'imp quel user, sinon peut upd que lui-meme
    public function updateUtilisateur(Request $request, $id) {
         $this->validate($request, ["pseudo" => 'required', "mail" => 'required', "pass" => 'required']);
         //si pas admin
         if($request->auth->idUtilisateur == 1 || $request->auth->idUtilisateur == 2) {
              //verifier si l'id rentré est le sien
              if($id != $request->auth->idUtilisateur) {
                   abort(403, "Ce n'est pas votre compte, vous ne pouvez pas le modifier !");
              }
         }
         $utilisateur = Utilisateur::findOrFail($id);
         $utilisateur->pseudo = $request->input('pseudo');
         $utilisateur->mail = $request->input('mail');
         $utilisateur->pass = $request->input('pass');
         //hashage mdp
         $utilisateur->pass = Crypt::encrypt($utilisateur->pass);
         $utilisateur->save();
         return response()->json(["utilisateur"=>$utilisateur], 200);
    }

    //suppr un utilisateur
    public function deleteUtilisateur($id) {
         $utilisateur = Utilisateur::findOrFail($id);
         $utilisateur->delete();
         return response()->json(['status' => 'Deleted'], 200);
    }
}
