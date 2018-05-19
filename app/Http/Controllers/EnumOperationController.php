<?php

namespace App\Http\Controllers;

use App\EnumOperation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Auth;


class EnumOperationController extends Controller
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

    //fetch toutes les opérations
    public function index() {
         $operations = EnumOperation::all();
         return response()->json($operations, 200);
    }
    //va chercher l'opération' avec l'id correspondant
    public function getOperation($id) {
         $operation = EnumOperation::findOrFail($id);
         return response()->json($operation, 200);
    }

    //crée une nouvelle opération
    public function saveOperation(Request $request) {
         $this->validate($request, ["intitule" => 'required']);
         $operation = EnumOperation::create($request->all());
         $operation->save();
         return response()->json($operation, 200);
    }

    //permet de modifier les informations d'une opération
    public function updateOperation(Request $request, $id) {
         $this->validate($request, ["intitule" => 'required']);
         $operation = EnumOperation::findOrFail($id);
         $operation->intitule = $request->input('intitule');
         $operation->save();
         return response()->json($operation, 200);
    }

    //suppr une opération
    public function deleteOperation($id) {
         $operation = EnumOperation::findOrFail($id);
         $operation->delete();
         return response()->json(['status' => 'Deleted'], 200);
    }
}
