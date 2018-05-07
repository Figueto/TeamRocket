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
         /*$this->middleware('auth',['except' => ['index','getOeuvre']]);
        $this->middleware('admin',['except' => ['index','getOeuvre']]);*/
    }

    //affiche tous les avis
    public function index() {
         $avis = DB::select("SELECT * FROM regarder");
         return response()->json(["liste_avis"=>$avis]);
    }

    //va chercher l'avis avec l'idUtilisateur et l'idOeuvre correspondants
    public function getAvis($idUtilisateur, $idOeuvre) {
         $avis = DB::select("SELECT * FROM regarder WHERE idUtilisateur = $idUtilisateur AND idOeuvre = $idOeuvre");
         return response()->json(["avis"=>$avis]);
    }

    //renvoie la liste des oeuvres qu'un user a regardé
    public function getHistorique($idUtilisateur) {
         $liste = DB::select("SELECT o.titre, r.dateVisionnage, o.dateSortie, o.lienBandeAnnonce, o.illustration, o.resume, o.keywords, o.saison, o.numEpisode, o.idSerie FROM regarder r, oeuvre o WHERE r.idUtilisateur = $idUtilisateur AND r.idOeuvre = o.idOeuvre ORDER BY r.dateVisionnage");
         return response()->json(["historique"=>$liste]);
    }

    //crée un nouvel avis (quand on met un media dans "regardés")
    //version avec parametres, marche pas
    /*public function saveAvis(Request $request, $idUtilisateur, $idOeuvre) {
         $this->validate($request, [ "dateVisionnage" => 'required']);
         //$avis = DB::insert("insert into regarder (idUtilisateur, idOeuvre) values (?, ?)", [$idUtilisateur, $idOeuvre]);
         $avis = Regarder::create($request->all());
         $avis->idUtilisateur = $idUtilisateur;
         $avis->idOeuvre = $idOeuvre;
         $request->input('dateVisionnage');
         return response()->json('created');
    }*/

    //version sans paramètres, marche pas non plus :
    // ErrorException : Illegal offset type, in HasAttributes.php (line 849)
    public function saveAvis(Request $request) {
         $this->validate($request, ["idUtilisateur" => 'required', "idOeuvre" => 'required', "dateVisionnage" => 'required']);
         $avis = (new Regarder($request->all()));
         $avis->save();
    }

    //permet de modifier les informations d'un avis, marche pas encore
    public function updateAvis(Request $request, $idUtilisateur, $idOeuvre) {
         //$avis = Regarder::find($idUtilisateur, $idOeuvre); fonction find marche pas avec plus d'un para

         // BadMethodCallException : Method Illuminate\Support\Collection::save does not exist.
         $avis = Regarder::where([ ['idUtilisateur', '=', $idUtilisateur], [ 'idOeuvre', '=', $idOeuvre] ])->get();

         // BadMethodCallException : Method Illuminate\Support\Collection::save does not exist.
         //$avis = DB::table('regarder')->where([ ['idUtilisateur', '=', $idUtilisateur], [ 'idOeuvre', '=', $idOeuvre] ])->get();

         //renvoie pas un objet, on peut donc pas accéder à ses champs
         //$avis = DB::select("SELECT * FROM regarder WHERE idUtilisateur = $idUtilisateur AND idOeuvre = $idOeuvre");

         $avis->dateVisionnage = $request->input('dateVisionnage');
         $avis->note = $request->input('note');
         $avis->avis = $request->input('avis');
         $avis->save();
         return response()->json(["avis"=>$avis]);
    }

    public function deleteAvis($idUtilisateur, $idOeuvre) {
         $avis =  DB::delete("DELETE FROM regarder WHERE idUtilisateur = $idUtilisateur AND idOeuvre = $idOeuvre");
         return response()->json(["status"=>'deleted']);
    }
}
