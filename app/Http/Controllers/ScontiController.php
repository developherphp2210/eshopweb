<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sconti;

class ScontiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        

        $sconti = Sconti::GetList();
        return view('users.anagrafica.lista_sconti')->with(['title' => 'Lista Sconti','index' => '8', 'listasconti' => $sconti]);
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
        $result['title'] = 'Gestione Sconti';
        $tmp = Sconti::InserisciSconto($request);        
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
        return Sconti::show($id);         
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
        $result['title'] = 'Gestione Sconti';
        $tmp = Sconti::ModificaSconto($request,$id);        
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
        $result['title'] = 'Gestione Sconti';
        $tmp = Sconti::CancellaSconto($id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }
}
