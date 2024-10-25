<?php

namespace App\Http\Controllers;

use App\Models\FidelityCard;
use App\Models\LineaFidelity;
use Illuminate\Http\Request;

class FidelityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('fidelity.fidelitycard')->with(['title' => 'Lista Tessere Fidelity','index' => '31']);
    }

    public function showlinea()
    {          
        return view('fidelity.lineafidelity')->with(['title' => 'Linea Fidelity','index' => '30']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function generazione(Request $request,string $id)
    {
        $result['title'] = 'Linea Tessere Fidelity';                
        $tmp = FidelityCard::GenrazioneFidelity($request,$id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result['title'] = 'Linea Tessere Fidelity';
        $tmp = LineaFidelity::LineaFidInsert($request);
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
        return LineaFidelity::Show($id);
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
        $result['title'] = 'Gestione Causali';
        $tmp = LineaFidelity::LineaFidUpdate($request,$id);
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
        $result['title'] = 'Gestione Causali';
        $tmp = LineaFidelity::LineaFidDelete($id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }


}
