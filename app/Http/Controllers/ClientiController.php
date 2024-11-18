<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clienti;
use App\Models\FidelityCard;
use App\Models\TestataScontrino;
use PhpParser\Node\Stmt\Case_;

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
    public function show(string $id,string $page)
    {
        $cliente['anagrafica'] = Clienti::GetCliente($id);
        switch ($page) {
            case '1':                
                $cliente['totpunti'] = FidelityCard::TotalePunti($id);
                $cliente['totprepagata'] = FidelityCard::TotalePrepagata($id);
                break;
            case '2':
                $cliente['transazioni'] = TestataScontrino::ListaTransazioniUtente($id);
                break;
            case '3':
                $cliente['fidelity'] = FidelityCard::GetListClienti($id);
                break;
        }        
        return view('users.anagrafica.schedacliente')->with(['title' => 'Anagrafica Cliente',
                                                              'page' => $page ,
                                                              'index' => '2',                                                              
                                                              'cliente' => $cliente]);
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
        $result['title'] = 'Gestione Cliente Fidelity';
        $tmp = Clienti::ClienteUpdate($request,$id);
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
        //
    }
}
