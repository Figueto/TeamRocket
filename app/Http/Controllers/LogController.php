<?php

namespace App\Http\Controllers;

use App\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Auth;


class LogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    //fetch tous les logs
    public function index() {
         $log = Log::all();
         return response()->json(["liste_log"=>$log], 200);
    }
    //va chercher le log avec l'id correspondant
    public function getLog($id) {
         $log = Log::findOrFail($id);
         return response()->json($log, 200);
    }

    //crée un nouveau log
    public function saveLog(Request $request) {
         $this->validate($request, ["idAdministrateur" => 'required']);
         $log = Log::create($request->all());
         $log->save();
         return response()->json(["log"=>$log], 200);
    }

    //permet de modifier les informations d'une opération
    public function updateLog(Request $request, $id) {
         $this->validate($request, ["idAdministrateur" => 'required']);
         $log = Log::findOrFail($id);
         $log->idAdministrateur = $request->input('idAdministrateur');
         $log->idOeuvre = $request->input('idOeuvre');
         $log->idSerie = $request->input('idSerie');
         $log->idEnumOperation = $request->input('idEnumOperation');
         $log->idCast = $request->input('idCast');
         $log->idUtilisateur = $request->input('idUtilisateur');
         $log->save();
         return response()->json($log, 200);
    }

    //suppr une opération
    public function deleteLog($id) {
         $log = Log::findOrFail($id);
         $log->delete();
         return response()->json(['status' => 'Deleted'], 200);
    }
}
