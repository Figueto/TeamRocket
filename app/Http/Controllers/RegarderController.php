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
         return response()->json($avis);
    }

    //va chercher l'avis avec l'idUtilisateur et l'idOeuvre correspondants
    public function getAvis($idUtilisateur, $idOeuvre) {
         $avis = DB::select("SELECT * FROM regarder WHERE idUtilisateur = $idUtilisateur AND idOeuvre = $idOeuvre");
         return response()->json($avis);
    }

    //renvoie la liste des oeuvres qu'un user a regardé
    public function getHistorique($idUtilisateur) {
         $liste = DB::select("SELECT o.titre, r.dateVisionnage, o.dateSortie, o.lienBandeAnnonce, o.illustration, o.resume, o.keywords, o.saison, o.numEpisode, o.idSerie FROM regarder r, oeuvre o WHERE r.idUtilisateur = $idUtilisateur AND r.idOeuvre = o.idOeuvre ORDER BY r.dateVisionnage");
         return response()->json($liste);
    }

    //cree un nouvel avis
    public function saveAvis(Request $request) {
         $this->validate($request, ["idUtilisateur" => 'required', "idOeuvre" => 'required', "dateVisionnage" => 'required']);
         $avis = Regarder::create($request->all());
         $avis->save();
         return response()->json($avis);
    }

    //permet de modifier les informations d'un avis
    public function updateAvis(Request $request, $idUtilisateur, $idOeuvre) {
          $this->validate($request, ["dateVisionnage" => 'required']);
          DB::table('regarder')
         ->where([ ['idUtilisateur', $idUtilisateur], [ 'idOeuvre', $idOeuvre] ])
         ->update(['dateVisionnage' =>$request->dateVisionnage, 'note' => $request->note, 'avis' => $request->avis]);
          return response()->json('updated');
    }

    //supprime un avis
    public function deleteAvis($idUtilisateur, $idOeuvre) {
         DB::delete("DELETE FROM regarder WHERE idUtilisateur = $idUtilisateur AND idOeuvre = $idOeuvre");
         return response()->json('deleted');
    }
}
