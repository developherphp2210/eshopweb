<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cassieri;
use App\Models\Profili;

class CassieriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listacassieri['cassieri'] = Cassieri::GetList();
        $listacassieri['profili'] = Profili::GetNameList();
        return view('users.anagrafica.lista_operatori')->with(['title' => 'Lista Cassieri','index' => '6', 'listacassieri' => $listacassieri]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result['title'] = 'Gestione Cassieri';
        $tmp = Cassieri::InserimentoCassieri($request);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Cassieri::Show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result['title'] = 'Gestione Cassieri';
        $tmp = Cassieri::AggiornaCassieri($request,$id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result['title'] = 'Gestione Cassieri';
        $tmp = Cassieri::CassieriDelete($id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }
}
