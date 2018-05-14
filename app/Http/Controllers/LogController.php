<?php

namespace App\Http\Controllers;

use App\Log;
use App\Http\Controllers\Controller;
use App\Cast;
use App\Oeuvre;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
         $log = DB::table('log')
         ->orderBy('created_at', 'desc')->get();
         return response()->json(["liste_log" => $log], 200);
    }
    //va chercher le log avec l'id correspondant
    public function getLog($id) {
         $log = Log::findOrFail($id);
         $log->enumOp = DB::table('enumoperation')
         ->where('idEnumOperation', $log->idEnumOperation)
         ->value('intitule');
         return response()->json($log, 200);
    }

    //crée un nouveau log
    /*
    *   @params : 
    *   TypeLog
    *   1 => 'Ajout'
    *   2 => 'Suppression'
    *   3 => 'Modification'
    *
    *   1 => Oeuvre 
    *   2 => Cast   
    *   3 => Utilisateur
    */
    public static function save(Request $request, int $typeLog, int $typeElement, int $idElement) {
        $idUtilisateur = $request->auth->idUtilisateur;
        switch ($typeElement) {
            case 1:
                $typeElement = "idOeuvre";
                break;
            case 2:
                $typeElement = "idCast";
                break;
            case 3:
                $typeElement = "idUtilisateur";
                break;
            default:
                break;
        }
        $log = Log::create(["idAdministrateur" => $idUtilisateur, "idEnumOperation" => $typeLog, $typeElement => $idElement]);
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
