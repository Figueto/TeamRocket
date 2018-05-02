<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Auth;


class GenreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','getGenre']]);
         $this->middleware('admin',['except' => ['index','getGenre']]);*/
    }

    //fetch tous les genres
    public function index() {
         $genres = Genre::all();
         return response()->json($genres, 200);
    }

    //va chercher le genre avec l'id correspondant
    public function getGenre($id) {
         $genre = Genre::findOrFail($id);
         return response()->json($genre, 200);
    }

    //crée un nouveau genre
    public function saveGenre(Request $request) {
          $this->validate($request, ["nom" => 'required']);
         $genre = Genre::create($request->all());
         $genre->save();
         return response()->json($genre, 200);
    }

    //permet de modifier les informations d'un genre
    public function updateGenre(Request $request, $id) {
         $this->validate($request, ["nom" => 'required']);
         $genre = Genre::findOrFail($id);
         $genre->nom = $request->input('nom');
         $genre->save();
         return response()->json($genre, 200);
    }

    public function deleteGenre($id) {
         $genre = Genre::findOrFail($id);
         $genre->delete();
         return response()->json(['status' => 'Deleted'], 200);
    }
}
