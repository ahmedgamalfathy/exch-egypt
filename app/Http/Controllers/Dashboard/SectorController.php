<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Sector;
use Illuminate\Http\Request;
use App\Imports\SectorImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectors=Sector::orderBy('created_at','desc')->paginate();
        return view('Dashboard.sectors.index',compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.sectors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "file"=>"required|mimes:xlsx,xls",
        ]);
        Excel::import(new SectorImport,$request->file('file'));
        return Redirect::to('/sectors')->with('message', 'تم استيراد الملف بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      $sector=Sector::findOrFail($id);
      return view('Dashboard.sectors.edit',compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       $data= $request->validate([
            "index"=>'required|string',
            "closing"=>'required|numeric',
            "change"=>'required|numeric',
            "change_percentage"=>'required|numeric',
            "high"=>'required|numeric',
            "low"=>'required|numeric',
            "volume"=>'required|numeric',
            "value"=>'required|numeric',
            "transactions"=>'required|numeric',
            "net_liquidity"=>'required|numeric'
        ]);
        $sector=Sector::findOrFail($id);
        $sector->update($data);
        return redirect()->route('sectors');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sector=Sector::findOrFail($id);
        $sector->delete();
        return back();
    }
}
