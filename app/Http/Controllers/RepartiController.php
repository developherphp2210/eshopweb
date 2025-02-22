<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reparti;

class RepartiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $reparti = Reparti::GetList();
        if (! session()->has('lastid') ){
            session()->put('lastid',$reparti[0]->id);
        } 
        return view('users.anagrafica.lista_reparti')->with(['title' => 'Lista Reparti','index' => '4', 'reparti' => $reparti]);

    }

    public function indexCasse(string $idcassa)
    {
        $result = [];
        try {
            $result['status'] = '200';
            $result['result'] = 'true';
            $result['items'] = Reparti::GetListCasse($idcassa);;    
        } catch (\Throwable $th) {
            $result['status'] = '400';
            $result['result'] = 'false';
            $result['error'] = $th->getMessage();
        }                
        return $result;
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
        $result['title'] = 'Gestione Reparti';
        $tmp = Reparti::InserimentoReparto($request);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result); 
        session()->put('lastid',$tmp['dati']->id);       
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Reparti::Show($id);
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
        $result['title'] = 'Gestione Reparti';
        $tmp = Reparti::RepartoUpdate($request,$id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result); 
        session()->put('lastid',$id);                              
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result['title'] = 'Gestione Reparti';
        $tmp = Reparti::RepartoDelete($id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }
}
