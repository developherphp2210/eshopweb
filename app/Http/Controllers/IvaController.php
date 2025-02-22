<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iva;

class IvaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        

        $iva = Iva::GetList();
        if (! session()->has('lastid') ){
            session()->put('lastid',$iva[0]->id);
        } 
        return view('users.anagrafica.lista_iva')->with(['title' => 'Lista Aliquote Iva','index' => '5', 'aliquote' => $iva]);
    }

    public function indexCasse(string $idcassa)
    {
        $result = [];
        try {
            $result['status'] = '200';
            $result['result'] = 'true';
            $result['items'] = Iva::GetListCasse($idcassa);;    
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
        $result['title'] = 'Gestione Aliquote IVA';
        $tmp = Iva::InserimentoIva($request);
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
        return Iva::SingleIva($id);         
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
        $result['title'] = 'Gestione Aliquote IVA';
        $tmp = Iva::IvaUpdate($request,$id);
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
        $result['title'] = 'Gestione Aliquote IVA';
        $tmp = Iva::IvaDelete($id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }
}
