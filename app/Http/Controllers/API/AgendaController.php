<?php

namespace App\Http\Controllers\API;

use App\Models\Agenda;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Imports\AgendasImoprt;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $agendas = Agenda::orderBy('created_at','desc')->paginate();
        return response()->json([
                "status"=>200,
                "data"=>$agendas,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $data=  $request->validate([
                "file"=>'required|mimes:xlsx,xls'
            ]);
            Excel::import(new AgendasImoprt, $data['file']);
            return response()->json([
                "status"=>200,
                "msg"=>"تم استيراد الملف بنجاح",
            ]);


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    try {
        $agenda =Agenda::findOrFail($id);
            return response()->json([
                "status"=>200,
                "data"=>$agenda
            ]);
    } catch (ModelNotFoundException $e) {
        return response()->json([
            "status"=>404,
            "msg"=>"هذا السجل لم يعد موجودا"
        ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        //
    }
}
