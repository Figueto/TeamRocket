<?php

namespace App\Http\Controllers;

use App\Regarder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class RegarderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth', ['except' => ['index','getAvis']]);
         $this->middleware('admin', ['except' => ['index','getAvis', 'getHistorique', 'updateAvis', 'deleteAvis', 'saveAvis']]);
    }

    //affiche tous les avis
    public function index() {
         $avis = DB::table('regarder')->get();
         return response()->json(["liste_avis"=>$avis], 200);
    }

    //va chercher les avis sur l'idOeuvre correspondant
    public function getAvis($idOeuvre) {
         $oeuvreExists = DB::table('oeuvre')
         ->where('idOeuvre', $idOeuvre)
         ->exists();
         if($oeuvreExists == false) {
              abort(500, "Oeuvre doesn't exist.");
         }
         $avis = DB::table('regarder')
         ->where('idOeuvre', $idOeuvre)
         ->get();

         return response()->json(["avis"=>$avis], 200);
    }

    //renvoie la liste des oeuvres qu'un user a regardé
    public function getHistorique(Request $request) {
         $idUtilisateur = $request->auth->idUtilisateur;
         $userExists = DB::table('utilisateur')
        ->where('idUtilisateur', $idUtilisateur)
        ->exists();
        if($userExists == false ) {
            abort(500, "User doesn't exist.");
        }
         $liste = DB::table('regarder')
         ->join('oeuvre', 'oeuvre.idOeuvre', 'regarder.idOeuvre')
         ->where('regarder.idUtilisateur', $idUtilisateur)
         ->orderBy('regarder.dateVisionnage', 'desc')
         ->get();
         return response()->json(["historique"=>$liste], 200);
    }

    //cree un nouvel avis
    public function saveAvis(Request $request) {
         $idUtilisateur = $request->auth->idUtilisateur;
         $this->validate($request, ["idOeuvre" => 'required', "dateVisionnage" => 'required|date']);
         $userExists = DB::table('utilisateur')
         ->where('idUtilisateur', $idUtilisateur)
         ->exists();
         $oeuvreExists = DB::table('oeuvre')
         ->where('idOeuvre', $request->input('idOeuvre'))
         ->exists();
         if($userExists == false || $oeuvreExists == false) {
              abort(500, "User or oeuvre doesn't exist.");
         }
         $avis = Regarder::create($request->all());
         DB::table('regarder')
         ->where([ ['idUtilisateur', 0], ['idOeuvre', $request->input('idOeuvre')] ])
         ->update(['idUtilisateur' => $idUtilisateur]);

         return response()->json(['avis' => $avis], 200);
    }

    //permet de modifier les informations d'un avis
    public function updateAvis(Request $request, $idOeuvre) {
         $idUtilisateur = $request->auth->idUtilisateur;
         $userExists = DB::table('utilisateur')
         ->where('idUtilisateur', $idUtilisateur)
         ->exists();
         $oeuvreExists = DB::table('oeuvre')
         ->where('idOeuvre', $idOeuvre)
         ->exists();
         if($userExists == false || $oeuvreExists == false) {
              abort(500, "User or oeuvre doesn't exist.");
         }
         if($request->has('dateVisionnage')) {
               $this->validate($request, ["dateVisionnage" => 'required|date']);
               DB::table('regarder')
               ->where([ ['idUtilisateur', $idUtilisateur], ['idOeuvre', $idOeuvre] ])
               ->update(['dateVisionnage' => $request->dateVisionnage]);
          }
          if($request->has('note')) {
               DB::table('regarder')
               ->where([ ['idUtilisateur', $idUtilisateur], ['idOeuvre', $idOeuvre] ])
               ->update(['note' => $request->note]);
          }
          if($request->has('avis')) {
               DB::table('regarder')
               ->where([ ['idUtilisateur', $idUtilisateur], ['idOeuvre', $idOeuvre] ])
               ->update(['avis' => $request->avis]);
          }
          $avis = DB::table('regarder')
          ->where([ ['idUtilisateur', $idUtilisateur], ['idOeuvre', $idOeuvre] ])->get();

          return response()->json(['avis' => $avis], 200);
    }

    //supprime un avis
    public function deleteAvis(Request $request, $idOeuvre) {
         $idUtilisateur = $request->auth->idUtilisateur;
         $userExists = DB::table('utilisateur')
         ->where('idUtilisateur', $idUtilisateur)
         ->exists();
         $oeuvreExists = DB::table('oeuvre')
         ->where('idOeuvre', $idOeuvre)
         ->exists();
         if($userExists == false || $oeuvreExists == false) {
              abort(500, "User or oeuvre doesn't exist.");
         }
         DB::table('regarder')
         ->where([ ['idUtilisateur', $idUtilisateur], ['idOeuvre', $idOeuvre] ])
         ->delete();
         return response()->json('deleted');
    }
}
