<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\StokResource;
use App\Models\Stok;
use App\Imports\StokImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StokUpdateRequest;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
class StokController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stoks=Stok::with('news')->orderBy('created_at','desc')->simplePaginate(10);
        return response()->json([
            "status"=>200,
            "data"=>$stoks
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                "file"=>"required|mimes:xlsx,xls",
            ]);
            Excel::import(new StokImport,$request->file('file'));
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
            $stok = Stok::with('news')->findOrFail($id);
            return response()->json([
                "status"=>200,
                "data"=>new StokResource($stok),
            ],200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "status"=>404,
                "msg"=>"Item not found"
            ],404);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StokUpdateRequest $request, $id)
    {
        try {
        $data=$request->validated();
        $stok= Stok::findOrFail($id);
        if(!$stok){
            return response()->json(["msg"=>"model not found"],404);
        }
        $stok->update($data);
        return response()->json([
               "status"=>200,
                "data"=>$stok,
        ],200);
        } catch (ValidationException $e) {
            return response()->json([
                "msg"=>"تأكد من صحة البيانات المدخلة",
            ],422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    try {
        $stok= Stok::findOrFail($id);
        $stok->delete();
        return response()->json([
            "status"=>200,
            "msg"=>"تم الحذف بنجاح"
        ],200);
    } catch (ModelNotFoundException $e) {
        return response()->json([
            "msg"=>"هذا السهم لم يعد موجود"
        ]);
    }

    }
    
}
