<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Privacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $privacy =Privacy::all();
        return view('Dashboard.privacys.index',compact('privacy'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.privacys.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->validate([
            'title'=>"string|required",
            "content"=>"required|string"
        ]);
        Privacy::create($data);
        return redirect()->route('privacy');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $privacy= Privacy::findOrFail($id);
        return view('Dashboard.privacys.edit',compact('privacy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title'=>"string|required",
            "content"=>"required|string"
        ]);
       $privacy= Privacy::findOrFail($id);
       $privacy->update($data);
       return redirect()->route('privacy');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      $privacy= Privacy::findOrFail($id);
      $privacy->delete();
      return back();
    }
}
