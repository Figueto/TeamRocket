<?php

namespace App\Http\Controllers;

use App\Serie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Auth;


class SerieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth',['except' => ['index','getSerie']]);
         $this->middleware('admin',['except' => ['index','getSerie']]);
    }

    //fetch toutes les series
    public function index() {
         $series = Serie::all();
         return response()->json($series, 200);
    }

    //va chercher la serie avec l'id correspondant
    public function getSerie($id) {
         $serie = Serie::findOrFail($id);
         return response()->json($serie, 200);
    }

    //crée une nouvelle serie
    public function saveSerie(Request $request) {
          $this->validate($request, ["titre" => 'required', "visible" => 'required']);
         $serie = Serie::create($request->all());
         $serie->save();
         return response()->json($serie, 200);
    }

    //permet de modifier les informations d'une serie
    public function updateSerie(Request $request, $id) {
         $this->validate($request, ["titre" => 'required', "visible" => 'required']);
         $serie = Serie::findOrFail($id);
         $serie->titre = $request->input('titre');
         $serie->resume = $request->input('resume');
         $serie->keywords = $request->input('keywords');
         $serie->save();
         return response()->json($serie, 200);
    }

    public function deleteSerie($id) {
         $serie = Serie::findOrFail($id);
         $serie->delete();
         return response()->json(['status' => 'Deleted'], 200);
    }
}
