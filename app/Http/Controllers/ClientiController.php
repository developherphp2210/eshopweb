<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clienti;

class ClientiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {          
        $clienti = Clienti::GetList();
        return view('users.anagrafica.lista_clienti')->with(['title' => 'Lista Clienti Fidelity','index' => '2', 'clienti' => $clienti]);
    }

    public function indexCasse(string $idcassa)
    {
        $result = [];
        try {
            $result['status'] = '200';
            $result['result'] = 'true';
            $result['items'] = Clienti::GetListCasse($idcassa);;    
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
