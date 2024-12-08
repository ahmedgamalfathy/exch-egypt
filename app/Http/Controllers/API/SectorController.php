<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SectorResource;
use App\Models\Sector;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Imports\SectorImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Dotenv\Exception\ValidationException;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $sectors=Sector::orderBy('created_at','desc')->paginate();
      return response()->json([
          "status"=>200,
          "data"=>SectorResource::collection($sectors)
      ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    try {
        $request->validate([
            "file"=>"required|mimes:xlsx,xls",
        ]);
        Excel::import(new SectorImport,$request->file('file'));
        return response()->json([
            "msg"=>'تم استيراد البيانات بنجاح',
        ],200);
    } catch (ValidationException $e) {
            return response()->json([
                "msg"=>'تأكد من ادخال البيانات  في ملف ا لاكسل بشكل صحيح'
            ],500);
       }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    try {
        $sector=Sector::findOrFail($id);
        return response()->json([
            "status"=>200,
            "data"=> new SectorResource($sector),
        ],200);
    } catch (ModelNotFoundException $e) {
        return  response()->json([
            "status"=>404,
            "msg"=>"هذا السجل لم يعد موجودا"
        ]);
    }

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sector $sector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $sector= Sector::findOrFail($id);
       $sector->delete();
       return response()->json([
           "status"=>200,
           "msg"=>"تم الحذف بنجاح ✔"
       ]);
    }
}
