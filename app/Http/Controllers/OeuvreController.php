<?php

namespace App\Http\Controllers;

use App\Oeuvre;
use App\Genre;
use App\Pays;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Auth;


class OeuvreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth',['except' => ['index','getOeuvre', 'nbreVues']]);
         $this->middleware('admin',['except' => ['index','getOeuvre', 'nbreVues']]);
    }

    //fetch toutes les oeuvres
    public function index() {
         $oeuvres = Oeuvre::all();
         return response()->json($oeuvres, 200);
    }

    //va chercher l'oeuvre + pays d'origine + genre avec l'id correspondant. Trouver un moyen de tout mettre dans le meme objet
    public function getOeuvre($id) {
         $oeuvre = Oeuvre::findOrFail($id);
         $genre = DB::select("SELECT g.nom as genreFilm FROM appartenir a, genre g WHERE a.idOeuvre = $id AND g.idGenre = a.idGenre");
         $pays = DB::select("SELECT p.nom as nomPays FROM origine o, pays p WHERE o.idOeuvre = $id AND p.idPays = o.idPays");
         $acteur =  DB::select("SELECT c.nom, c.prenom FROM jouer j, cast c WHERE j.idOeuvre = $id AND c.idCast = j.idCast");
         $real =  DB::select("SELECT c.nom, c.prenom FROM realiser r, cast c WHERE r.idOeuvre = $id AND c.idCast = r.idCast");
         return response()->json([$oeuvre, $genre, $pays, $acteur, $real], 200);
    }

    //renvoie le nombre de fois que cette oeuvre a été vue
    public function nbreVues($id) {
         $vues = DB::select("SELECT COUNT(idOeuvre) as nbrevues FROM regarder WHERE idOeuvre = $id");
         return response()->json($vues, 200);
    }

    //crée une nouvelle oeuvre et les lignes correspondantes dans les tables d'union Appartenir et Origine
    public function saveOeuvre(Request $request) {
          $this->validate($request, ["titre" => 'required', "slug" => 'required|unique:oeuvre']);
         $oeuvre = Oeuvre::create($request->all());
         $oeuvre->save();

         //cree entrée dans Appartenir
         if($request->has('genre')) {
             $nomGenre = $request->input('genre');
             $idGenre = DB::table('genre')
             ->where('nom', $nomGenre)
             ->value('idGenre');
             DB::table('appartenir')
             ->insert(['idGenre' => $idGenre, 'idOeuvre' => $oeuvre->idOeuvre]);
        }

        //crée entrée dans Origine
         if($request->has('pays')) {
              $nomPays = $request->input('pays');
              $idPays = DB::table('pays')
             ->where('nom', $nomPays)
             ->value('idPays');
             DB::table('origine')
             ->insert(['idPays' => $idPays, 'idOeuvre' => $oeuvre->idOeuvre]);
        }
         return response()->json($oeuvre, 200);
    }

    //permet de modifier les informations d'une oeuvre
    public function updateOeuvre(Request $request, $id) {
         $this->validate($request, ["titre" => 'required', "slug" => 'required']);
         $oeuvre = Oeuvre::findOrFail($id);
         $oeuvre->titre = $request->input('titre');
         $oeuvre->dateSortie = $request->input('dateSortie');
         $oeuvre->lienBandeAnnonce = $request->input('lienBandeAnnonce');
         $oeuvre->illustration = $request->input('illustration');
         $oeuvre->slug = $request->input('slug');
         $oeuvre->resume = $request->input('resume');
         $oeuvre->keywords = $request->input('keywords');
         $oeuvre->saison = $request->input('saison');
         $oeuvre->numEpisode = $request->input('numEpisode');
         $oeuvre->idSerie = $request->input('idSerie');
        // $oeuvre->save();

         if($request->has('genre')) {
              $nomGenre = $request->input('genre');
              $idGenre = DB::table('genre')
              ->where('nom', $nomGenre)
              ->value('idGenre');
              DB::table('appartenir')
              ->where('idOeuvre', $id)
              ->update(['idGenre' => $idGenre ]);
         }

         if($request->has('pays')) {
              $nomPays = $request->input('pays');
              $idPays = DB::table('pays')
              ->select('idPays')
              ->where('nom', $nomPays)
              ->value('idPays');
              DB::table('origine')
              ->where('idOeuvre', $id)
              ->update(['idPays' => $idPays]);
         }
         return response()->json($oeuvre, 200);
    }

    public function deleteOeuvre($id) {
         $oeuvre = Oeuvre::findOrFail($id);
         $oeuvre->delete();
  //suppr entrée dans Appartenir
         $rowAppExist = DB::table('appartenir')
         ->where('idOeuvre', $id)->exists();
         if($rowAppExist == true) {
              DB::table('appartenir')
              ->where('idOeuvre', $id)
              ->delete();
        }
  //suppr entrée dans Origine
        $rowOriginExist = DB::table('origine')
        ->where('idOeuvre', $id)->exists();
        if($rowOriginExist == true) {
            DB::table('origine')
            ->where('idOeuvre', $id)
            ->delete();
       }
         return response()->json(['status' => 'Deleted'], 200);
    }
}
