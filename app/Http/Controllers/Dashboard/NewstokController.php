<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Stok;
use App\Models\Newstok;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewstokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news=Newstok::orderBy('created_at','desc')->paginate();
        return view('Dashboard.news.index',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stoks=Stok::select('stock_name','id')->get();
        return view('Dashboard.news.create',compact('stoks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     "title"=>"required|string",
        //     "stok_id"=>"nullable|exists:news,id",
        //     "notes"=>"required|string",
        //     "file"=>"nullable|mimes:png,jpg,webg,pdf"
        // ]);
        // if($request->hasFile('file')){
        // $request->post('file')=$request->file('file')->store('news','image');
        // }
        Newstok::create($request->all());
        return redirect()->route('news');
    }

    /**
     * Display the specified resource.
     */
    public function show(Newstok $newstok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $new=Newstok::findOrFail($id);
        $stoks=Stok::select('stock_name','id')->get();
        return view('Dashboard.news.edit',compact(['stoks','new']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data= $request->validate([
            "title"=>"required|string",
            "stok_id"=>"nullable|exists:news,id",
            "notes"=>"required|string",
        ]);
        $new=Newstok::findOrFail($id);
        $new->update($data);
        return redirect()->route('news');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $new=Newstok::findOrFail($id);
        $new->delete();
        return back();
    }
}
