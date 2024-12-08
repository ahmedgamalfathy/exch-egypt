<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\SFree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SFreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $sfrees=SFree::all();
       return view('Dashboard.SFree.index',compact('sfrees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.sfree.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $data=$request->validate([
            "title"=>'string|required',
            "distrip"=>'string|required',
            "entitle_date"=>'date|required',
            'dis_date'=>'date|required'
        ]);
        SFree::create($data);
        return redirect()->route('sfree.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sfree=SFree::findOrFail($id);
        return view('Dashboard.sfree.edit',compact('sfree'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data=$request->validate([
            "title"=>'string|nullable',
            "distrip"=>'string|nullable',
            "entitle_date"=>'date|nullable',
            'dis_date'=>'date|nullable'
        ]);
        $sfree=SFree::findOrFail($id);
        $sfree->update($data);
        return redirect()->route('sfree.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sfree=SFree::findOrFail($id);
        $sfree->delete();
        return back();
    }
}
