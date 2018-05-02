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
         //$this->middleware('auth',['except' => ['index','getOeuvre', 'nbreVues']]);
         //$this->middleware('admin',['except' => ['index','getOeuvre', 'nbreVues']]);
    }

    //fetch toutes les oeuvres
    public function index() {
         $oeuvres = Oeuvre::all();
         return response()->json($oeuvres, 200);
    }

    //va chercher l'oeuvre + pays d'origine + genre + acteurs + real avec l'id correspondant. Trouver un moyen de tout mettre dans le meme objet
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

    //crée une nouvelle oeuvre et les lignes correspondantes dans les tables d'union Appartenir, Origine, Jouer, Realiser
    public function saveOeuvre(Request $request) {
          $this->validate($request, ["titre" => 'required', "slug" => 'required|unique:oeuvre']);
         $oeuvre = Oeuvre::create($request->all());
         $oeuvre->save();

         //marche pas : Object of class Illuminate\Database\Query\Builder could not be converted to string
         /*var_dump($request->input('genre'));
         if( null !== $request->input('genre')) {
             $nomGenre = $request->input('genre'); //
             $idGenre = DB::table('genre')
             ->select('idGenre')
             ->where('nom', $nomGenre);
             DB::table('appartenir')
             ->insert(['idGenre' => $idGenre, 'idOeuvre' => $oeuvre->idOeuvre]);
        }
         if($request->input('pays') != null) {
              $nomPays = $request->input('pays');
              $idPays = DB::table('pays')
             ->select('idPays')
             ->where('nom', $nomPays);
              DB::table('origine')
             ->insert(['idPays' => $idPays, 'idOeuvre' => $oeuvre->idOeuvre]);
        }*/
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
         $oeuvre->save();
         return response()->json($oeuvre, 200);
    }

    public function deleteOeuvre($id) {
         $oeuvre = Oeuvre::findOrFail($id);
         $oeuvre->delete();
         return response()->json(['status' => 'Deleted'], 200);
    }
}
