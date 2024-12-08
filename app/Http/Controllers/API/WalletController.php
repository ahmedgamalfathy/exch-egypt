<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\NewResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Wallet;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $wallets=$request->user()->wallets;
        return response()->json([
                "status"=>200,
                "data"=> $wallets
        ]);
    }

    public function show($id)
    {
        try {
            $wallet =Wallet::findOrFail($id);
            return response()->json([
                 "message"=>200,
                 "data"=>$wallet
             ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message'=>$e,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message'=>$e,
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //stok_code , count, curr
        try {
            $validated=$request->validate([
                "stok_code"=>'required|string|exists:stoks,code',
                "count"=>'required|integer',
            ]);
           $validated['user_id']=$request->user()->id;
           $validated['curr']=$request->post('count')*$request->post('buy_price');
           $wallet= Wallet::create($validated);
            return response()->json([
                'status'=>200,
                "data"=>$wallet
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message'=>$e,
            ]);
        }

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
              //stok_code , count, curr
              try {
                $validated=$request->validate([
                    "stok_code"=>'required|string|exists:stoks,code',
                    "count"=>'required|integer',
                ]);
               $validated['user_id']=$request->user()->id;
               $validated['curr']=$request->post('count')*$request->post('buy_price');
               $wallet= Wallet::findOrFail($id);
               $wallet->update($validated);
                return response()->json([
                    'status'=>200,
                    "data"=>$wallet
                ]);
            } catch (ValidationException $e) {
                return response()->json([
                    'message'=>$e,
                ]);
            }catch (ModelNotFoundException $e) {
                return response()->json([
                    'message'=>"model not found",
                ]);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wallet =Wallet::findOrFail($id);
        $wallet->delete();
        return response()->json([
            "message"=>200,
            "data"=>"Deleted successfully"
        ]);
    }
}
