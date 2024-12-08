<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Imports\AgendasImoprt;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $agendas =Agenda::orderBy('created_at','desc')->paginate();
       return view('Dashboard.agendas.index',compact('agendas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.agendas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=  $request->validate([
            "file"=>'required|mimes:xlsx,xls'
        ]);
        Excel::import(new AgendasImoprt, $data['file']);
        return Redirect::to('/agendas');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $agenda =Agenda::findOrFail($id);
        return view('Dashboard.agendas.edit',compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $agenda =Agenda::findOrFail($id);
        $agenda->update($request->all());
        return redirect()->route('agendas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        //
    }
}
