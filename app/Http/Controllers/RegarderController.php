<?php

namespace App\Http\Controllers;

use App\Regarder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RegarderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth', ['except' => ['index','getAvis', 'getHistorique']]);
         $this->middleware('admin', ['except' => ['index','getAvis', 'getHistorique', 'updateAvis', 'deleteAvis', 'saveAvis']]);
    }

    //affiche tous les avis
    public function index() {
         $avis = DB::select("SELECT * FROM regarder");
         return response()->json(["liste_avis"=>$avis]);
    }

    //va chercher l'avis avec l'idUtilisateur et l'idOeuvre correspondants
    public function getAvis($idUtilisateur, $idOeuvre) {
         $userExists = DB::table('utilisateur')
         ->where('idUtilisateur', $idUtilisateur)
         ->exists();
         $oeuvreExists = DB::table('oeuvre')
         ->where('idOeuvre', $idOeuvre)
         ->exists();
         if($userExists == false || $oeuvreExists == false) {
              abort(500, "User or oeuvre doesn't exist.");
         }
         $avis = DB::select("SELECT * FROM regarder WHERE idUtilisateur = $idUtilisateur AND idOeuvre = $idOeuvre");
         return response()->json(["avis"=>$avis]);
    }

    //renvoie la liste des oeuvres qu'un user a regardé
    public function getHistorique($idUtilisateur) {
         $liste = DB::select("SELECT o.titre, r.dateVisionnage, o.dateSortie, o.lienBandeAnnonce, o.illustration, o.resume, o.keywords, o.saison, o.numEpisode, o.idSerie FROM regarder r, oeuvre o WHERE r.idUtilisateur = $idUtilisateur AND r.idOeuvre = o.idOeuvre ORDER BY r.dateVisionnage");
        return response()->json(["historique"=>$liste]);
    }

    //cree un nouvel avis
    public function saveAvis(Request $request) {
         $this->validate($request, ["idUtilisateur" => 'required', "idOeuvre" => 'required', "dateVisionnage" => 'required|date']);
         $userExists = DB::table('utilisateur')
         ->where('idUtilisateur', $request->input('idUtilisateur'))
         ->exists();
         $oeuvreExists = DB::table('oeuvre')
         ->where('idOeuvre', $request->input('idOeuvre'))
         ->exists();
         if($userExists == false || $oeuvreExists == false) {
              abort(500, "User or oeuvre doesn't exist.");
         }
         $avis = Regarder::create($request->all());
         $avis->save();
         return response()->json(["avis"=>$avis]);
    }

    //permet de modifier les informations d'un avis
    public function updateAvis(Request $request, $idUtilisateur, $idOeuvre) {
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
          if($request->has('note')) { //bug si on a pas mis de note
               DB::table('regarder')
               ->where([ ['idUtilisateur', $idUtilisateur], ['idOeuvre', $idOeuvre] ])
               ->update(['note' => $request->note]);
          }
          if($request->has('avis')) {//bug si on a pas mis d'avis
               DB::table('regarder')
               ->where([ ['idUtilisateur', $idUtilisateur], ['idOeuvre', $idOeuvre] ])
               ->update(['avis' => $request->avis]);
          }
          // return response()->json('updated'); 
          // Doit etre changé par return response()->json(["avis"=>$avis]);
    }

    //supprime un avis
    public function deleteAvis($idUtilisateur, $idOeuvre) {
         $userExists = DB::table('utilisateur')
         ->where('idUtilisateur', $idUtilisateur)
         ->exists();
         $oeuvreExists = DB::table('oeuvre')
         ->where('idOeuvre', $idOeuvre)
         ->exists();
         if($userExists == false || $oeuvreExists == false) {
              abort(500, "User or oeuvre doesn't exist.");
         }
         DB::delete("DELETE FROM regarder WHERE idUtilisateur = $idUtilisateur AND idOeuvre = $idOeuvre");
         return response()->json(["status"=>'deleted']);
    }
}
