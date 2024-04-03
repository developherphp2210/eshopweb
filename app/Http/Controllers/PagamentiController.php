<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamenti;

class PagamentiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        

        $pagamenti = Pagamenti::GetList();
        return view('users.anagrafica.lista_pagamenti')->with(['title' => 'Lista Pagamenti','index' => '9', 'listapagamenti' => $pagamenti]);
    }

    public function indexCasse(string $idcassa)
    {
        $result = [];
        try {
            $result['status'] = '200';
            $result['result'] = 'true';
            $result['items'] = Pagamenti::GetListCasse($idcassa);;    
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
        $result['title'] = 'Gestione Pagamenti';
        $tmp = Pagamenti::InserisciPagamento($request);        
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
        return Pagamenti::show($id);         
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
        $result['title'] = 'Gestione Pagamenti';
        $tmp = Pagamenti::ModificaPagamento($request,$id);        
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
        $result['title'] = 'Gestione Pagamenti';
        $tmp = Pagamenti::CancellaPagamento($id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }
}
