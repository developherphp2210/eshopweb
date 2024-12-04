<?php

namespace App\Http\Controllers;

use App\Models\FidelityCard;
use App\Models\FidelityClienti;
use App\Models\LineaFidelity;
use App\Models\Puntipromo;
use App\Models\TestataScontrino;
use App\MyClass\MyLog;
use App\MyClass\Utility;
use Illuminate\Http\Request;

class FidelityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.fidelity.fidelitycard')->with(['title' => 'Lista Tessere Fidelity','index' => '31']);
    }

    public function indexLista()
    {
        $listaFidelity = FidelityCard::GetListUtenti(session('user')->id);
        return view('fidelity.card.lista_fidelity')->with(['title' => 'Lista Tessere Fidelity','index' => '2','listafidelity' => $listaFidelity]);
    }

    public function RichiestaPunti($id)
    {                                
        $result = [];
        try {
            $result['status'] = '200';
            $result['result'] = 'true';
            $result['items'] = Puntipromo::RichiestaPunti($id);    
        } catch (\Throwable $th) {
            $result['status'] = '400';
            $result['result'] = 'false';
            $result['error'] = $th->getMessage();
        }                
        return $result;
    }

    public function indexCasse(string $idcassa)
    {
        $result = [];
        try {
            $result['status'] = '200';
            $result['result'] = 'true';
            $result['items'] = FidelityCard::GetListCasse($idcassa);    
        } catch (\Throwable $th) {
            $result['status'] = '400';
            $result['result'] = 'false';
            $result['error'] = $th->getMessage();
        }                
        return $result;
    }

    public function indexLineaCasse(string $idcassa)
    {
        $result = [];
        try {
            $result['status'] = '200';
            $result['result'] = 'true';            
            $result['items'] = LineaFidelity::GetListCasse($idcassa);    
        } catch (\Throwable $th) {
            $result['status'] = '400';
            $result['result'] = 'false';
            $result['error'] = $th->getMessage();
        }                
        return $result;
    }

    public function showlinea()
    {          
        return view('users.fidelity.lineafidelity')->with(['title' => 'Linea Fidelity','index' => '30']);
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

    public function CollegaFidelityCliente(Request $request)
    {
        $result['title'] = 'Gestione Fidelity';
        $tmp = FidelityCard::FidelityClienti($request);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
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
        $result['title'] = 'Gestione Fidelity';
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
        $result['title'] = 'Gestione Fidelity';
        $tmp = LineaFidelity::LineaFidDelete($id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }

    public function addFidelity(Request $request)
    {
        $result['title'] = 'Gestione Fidelity';
        $tmp = FidelityCard::AssociaFidelity($request);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }

    public function listatransazioni()
    {
        $cliente = FidelityClienti::where('id_utente',session('user')->id)->first();
        $lista = TestataScontrino::ListaTransazioniUtente($cliente->id_cliente);
        return view('fidelity.lista_transazioni')->with(['title' => 'Lista Transazioni','index' => '3','lista' => $lista]);
    }


}
