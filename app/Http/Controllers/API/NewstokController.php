<?php

namespace App\Http\Controllers\API;

use App\Models\Newstok;
use Illuminate\Http\Request;
use App\Http\Resources\NewResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NewstokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news=Newstok::orderBy('created_at','desc')->simplePaginate(10);
        return response()->json([
            "status"=>200,
            "data"=> NewResource::collection($news)
        ],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try {
        $data=$request->validate([
            "stok_id"=>"nullable|exists:stoks,id",
            "title"=>"nullable|string",
            "notes"=>"required|string",
            "file"=>"nullable|mimes:png,jpg,webg,pdf"
        ]);
        if($request->hasFile('file')){
        $data['file']=$request->file('file')->store('news','image');
        }
        $news= Newstok::create($data);
            return response()->json([
                "status"=>200,
                "data"=>$news
            ],200);
       } catch (ValidationException $e) {
           return response()->json([
               "msg"=>"برجاء التحقق من البيانات"
           ],422);
       }


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
          $new= Newstok::findOrFail($id);
          return response()->json([
              "status"=>200,
              "data"=>new NewResource($new),
          ],200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "msg"=>"هذا السجل غير موجود "
            ],404);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    try {
        $data=$request->validate([
            "stok_id"=>"nullable|exists:stoks,id",
            "title"=>"nullable|string",
            "notes"=>"nullable|string",
            "file"=>"nullable|mimes:png,jpg,webg,pdf"
        ]);
        $new= Newstok::findOrFail($id);
        if($request->hasFile('file')){
            if($new->file){
            Storage::disk('image')->delete($new->file);
            }
            $data['file']=$request->file('file')->store('news','image');
            }
        if(!$new){
            return response()->json([
                "msg"=>"model not found"
            ],404);
        }
        $new->update($data);
        return response()->json([
            "data"=>$new
        ],200);
    } catch (ValidationException $e) {
        return response()->json([
           "mse"=>$e
        ]);
    }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $new =Newstok::findOrFail($id);
            $new->delete();
            return response()->json([
                'msg'=>"تم حذف السجل بنجاح👍",
            ],422);
        } catch (ModelNotFoundException $th) {
            return response()->json([
                'msg'=>"هذا السجل لم يعد موجودا",
            ],404);
        }


    }
}
