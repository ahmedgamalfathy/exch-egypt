<?php

namespace App\Http\Controllers\API;

use App\Models\Privacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    public function index(){
        $privacy=Privacy::all();
            return response()->json([
                "status"=>200,
                "data"=>$privacy
            ]);
    }
}
