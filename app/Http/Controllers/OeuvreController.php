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
         return response()->json(['liste_oeuvre'=>$oeuvres], 200);
    }

    //va chercher l'oeuvre avec l'id correspondant
    public function getOeuvre($id) {
         $oeuvre = Oeuvre::findOrFail($id);
         return response()->json(['oeuvre'=>$oeuvre], 200);
    }

    //renvoie le nombre de fois que cette oeuvre a été vue
    public function nbreVues($id) {
         $vues = DB::select("SELECT COUNT(idOeuvre) as nbrevues  FROM regarder WHERE idOeuvre = $id");
         return response()->json($vues, 200);
    }

    //crée une nouvelle oeuvre
    public function saveOeuvre(Request $request) {
        $this->validate($request, ["titre" => 'required', "slug" => 'required|unique:oeuvre']);
        $oeuvre = Oeuvre::create($request->all());
        $oeuvre->save();
        return response()->json(['oeuvre'=>$oeuvre], 200);
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
         return response()->json(['oeuvre'=>$oeuvre], 200);
    }

    public function deleteOeuvre($id) {
         $oeuvre = Oeuvre::findOrFail($id);
         $oeuvre->delete();
         return response()->json(['status' => 'Deleted'], 200);
    }
}
