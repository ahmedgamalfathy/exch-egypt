<?php

namespace App\Http\Controllers\API;

use App\Models\SFree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SFreeController extends Controller
{
    public function index()
    {
       $sfrees=SFree::all();
        return response()->json([
                "status"=>200,
                "data"=>$sfrees
            ]);
    }
}
