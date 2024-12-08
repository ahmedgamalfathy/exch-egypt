<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Stok;
use App\Imports\StokImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StokUpdateRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stoks=Stok::orderBy('created_at','desc')->paginate();
        return view('Dashboard.stoks.index',compact('stoks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.stoks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
                "file"=>"required|mimes:xlsx,xls",
            ]);
            Excel::import(new StokImport,$request->file('file'));
           return Redirect::to('/stoks')->with('message', 'تم استيراد الملف بنجاح');

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stok=Stok::findOrFail($id);
        return view('Dashboard.stoks.edit',compact('stok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StokUpdateRequest $request, $id)
    {

            $data=$request->validated();
            $stok= Stok::findOrFail($id);
            if(!$stok){
                throw ModelNotFoundException::withMessages([
                'error'=>'هذا المودل لم يعد موجود',
                ]);
            }
            $stok->update($data);
            return redirect()->route('stoks');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      $stok=Stok::findOrFail($id);
      $stok->delete();
      return back();
    }
}
