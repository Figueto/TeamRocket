<?php

namespace App\Http\Controllers;

use App\Oeuvre;
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
         return response()->json(['liste_oeuvre' => $oeuvres], 200);
    }

    //renvoie le nombre de fois que cette oeuvre a été vue
    public function nbreVues($id) {
         $oeuvreExists = DB::table('oeuvre')
         ->where('idOeuvre', $id)
         ->exists();
         if($oeuvreExists == false) {
              abort(500, "Oeuvre doesn't exist.");
         }
         $vues = DB::select("SELECT COUNT(idOeuvre) FROM regarder WHERE idOeuvre = $id");
         return $vues;
    }

    //va chercher l'oeuvre + pays d'origine + genre + acteurs + réals avec l'id correspondant
    public function getOeuvre($id) {
         $oeuvre = Oeuvre::findOrFail($id);
         $genres = DB::table('genre')
         ->join('appartenir', 'genre.idGenre', 'appartenir.idGenre')
         ->where('appartenir.idOeuvre', $id)
         ->pluck('genre.nom');
         $pays = DB::table('pays')
         ->join('origine', 'pays.idPays', 'origine.idPays')
         ->where('origine.idOeuvre', $id)
         ->pluck('pays.nom');
         $acteurs = DB::table('cast')
         ->join('jouer', 'cast.idCast', 'jouer.idCast')
         ->where('jouer.idOeuvre', $id)
         ->select('cast.nom', 'cast.prenom')
         ->get();
         $real = DB::table('cast')
         ->join('realiser', 'cast.idCast', 'realiser.idCast')
         ->where('realiser.idOeuvre', $id)
         ->select('cast.nom', 'cast.prenom')
         ->get();
         $vues = DB::table('regarder')
         ->where('idOeuvre', $id)
         ->count();

         return response()->json([
              'Id' => $oeuvre->idOeuvre,
              'Titre' => $oeuvre->titre,
              'Date de sortie' => $oeuvre->dateSortie,
              'Bande-annonce' => $oeuvre->lienBandeAnnonce,
              'Illustration' => $oeuvre->illustration,
              'Slug' => $oeuvre->slug,
              'Résumé' => $oeuvre->resume,
              'Keywords' => $oeuvre->keywords,
              "Série" => $oeuvre->idSerie,
              'Saison' => $oeuvre->saison,
              'Episode' => $oeuvre->numEpisode,
              'Genres' => $genres,
              "Pays d'origine" =>$pays,
              'Acteurs' =>$acteurs,
              'Réalisateurs' => $real,
              'Nombre de vues' => $vues
         ], 200);
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
         return response()->json(['oeuvre' => $oeuvre], 200);
    }

    public function getRecommendations($idUtilisateur) {
         //si rien dans l'historique, proposer les oeuvres avec le plus grand nbre de vues
         $historiqueExists = DB::table('regarder')
         ->where('idUtilisateur', $idUtilisateur)->exists();
         if($historiqueExists == false) {
              $recos =  DB::table('regarder')
             ->join('oeuvre', 'oeuvre.idOeuvre', 'regarder.idOeuvre')
             ->groupBy('regarder.idOeuvre')
             ->orderBy(DB::raw("COUNT(regarder.idOeuvre)"), 'desc')
             ->value('oeuvre.titre');
              return response()->json(['recos' => $recos], 200);
         }

          //sélectionner le genre le plus regardé par l'User
          $idGenreAime = DB::table('regarder')
          ->where('idUtilisateur', $idUtilisateur)
          ->join('appartenir', 'regarder.idOeuvre', 'appartenir.idOeuvre')
          ->join('genre', 'appartenir.idGenre', 'genre.idGenre')
          ->groupBy('appartenir.idGenre')
          ->orderBy(DB::raw("COUNT(appartenir.idGenre)"), 'desc')
          ->value('genre.idGenre');

          //sélectionne 5 oeuvres ayant ce genre (que l'user a pas encore vu)
          $recos = DB::table('oeuvre')
          ->join('appartenir', 'oeuvre.idOeuvre', 'appartenir.idOeuvre')
          ->where('appartenir.idGenre', $idGenreAime)
          ->whereRaw("NOT EXISTS (SELECT r.idOeuvre from regarder r WHERE r.idOeuvre = oeuvre.idOeuvre AND r.idUtilisateur = $idUtilisateur)")
          ->select("oeuvre.titre")
          ->take(5)
          ->get();

          return response()->json(['recos' => $recos], 200);
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

         if($request->has('genre')) {
              $nomGenre = $request->input('genre');
              $idGenre = DB::table('genre')
              ->where('nom', $nomGenre)
              ->value('idGenre');
              if($idGenre == null) {
                   abort(500, 'Invalid genre name');
              }
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
              if($idPays == null) {
                     abort(500, 'Invalid country name');
                }
                DB::table('origine')
               ->where('idOeuvre', $id)
               ->update(['idPays' => $idPays]);

               return response()->json(['oeuvre'=>$oeuvre], 200);
          }
     }

//TRUCS EN PLUS :

    //permet d'ajouter un genre à une oeuvre
    public function addGenre(Request $request, $id) {
         $this->validate($request, ["genre" => 'required']);
         $nomGenre = $request->input('genre');
         $idGenre = DB::table('genre')
         ->where('nom', $nomGenre)
         ->value('idGenre');
         if($idGenre == null) {
              abort(500, 'Invalid genre name');
         }
         $rowAppExist = DB::table('appartenir')
         ->where([ ['idOeuvre', $id], ['idGenre', $idGenre]])->exists();
         if($rowAppExist == false) {
              DB::table('appartenir')
              ->insert(['idGenre' => $idGenre, 'idOeuvre' => $id]);
        }
          return response()->json('genre added', 200);
    }

    //permet d'ajouter un pays d'origine à une oeuvre
    public function addPays(Request $request, $id) {
         $this->validate($request, ["pays" => 'required']);
         $nomPays = $request->input('pays');
         $idPays = DB::table('pays')
         ->where('nom', $nomPays)
         ->value('idPays');
         if($idPays == null) {
              abort(500, 'Invalid country name');
         }
         $rowOriginExist = DB::table('origine')
         ->where([ ['idOeuvre', $id], ['idPays', $idPays] ])->exists();
         if($rowOriginExist == false) {
              DB::table('origine')
              ->insert(['idPays' => $idPays, 'idOeuvre' => $id]);
        }
          return response()->json('pays added', 200);
    }

    //permet d'ajouter un acteur à une oeuvre
    public function addActeur(Request $request, $id) {
         $this->validate($request, ["nom" => 'required', "prenom" => 'required']);
         $nomActeur = $request->input('nom');
         $prenomActeur = $request->input('prenom');
         $idActeur = DB::table('cast')
         ->where([ ['nom', $nomActeur], ['prenom', $prenomActeur] ])
         ->value('idCast');
         if($idActeur == null) {
              abort(500, "Error: cast is invalid or doesn't exist. ");
         }
         $rowJouerExist = DB::table('jouer')
         ->where([ ['idOeuvre', $id], ['idCast', $idActeur] ])->exists();
         if($rowJouerExist == false) {
              DB::table('jouer')
              ->insert(['idCast' => $idActeur, 'idOeuvre' => $id]);
        }
          return response()->json('actor added', 200);
    }

 //permet d'ajouter un réalisateur à une oeuvre
    public function addReal(Request $request, $id) {
         $this->validate($request, ["nom" => 'required', "prenom" => 'required']);
         $nomReal = $request->input('nom');
         $prenomReal = $request->input('prenom');
         $idReal = DB::table('cast')
         ->where([ ['nom', $nomReal], ['prenom', $prenomReal] ])
         ->value('idCast');
         if($idReal == null) {
              abort(500, "Error: cast is invalid or doesn't exist. ");
         }
         $rowRealExist = DB::table('realiser')
         ->where([ ['idOeuvre', $id], ['idCast', $idReal] ])->exists();
         if($rowRealExist == false) {
              DB::table('realiser')
              ->insert(['idCast' => $idReal, 'idOeuvre' => $id]);
        }
          return response()->json('real added', 200);
    }

    //suppr une oeuvre et les entrée correspondantes dans les autres tables
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
//suppr entrées dans Jouer
       $rowJouerExist = DB::table('jouer')
       ->where('idOeuvre', $id)->exists();
       if($rowOriginExist == true) {
          DB::table('jouer')
          ->where('idOeuvre', $id)
          ->delete();
     }
//suppr entrées dans Realiser
       $rowRealExist = DB::table('realiser')
       ->where('idOeuvre', $id)->exists();
       if($rowRealExist == true) {
          DB::table('realiser')
          ->where('idOeuvre', $id)
          ->delete();
     }
//suppr entrées dans Regarder
     $rowRegarderExist = DB::table('regarder')
     ->where('idOeuvre', $id)->exists();
     if($rowRegarderExist == true) {
        DB::table('regarder')
        ->where('idOeuvre', $id)
        ->delete();
   }
         return response()->json(['status' => 'Deleted'], 200);
    }
}
