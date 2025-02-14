<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        session()->put('lastid',1);       
        return view('users.anagrafica.lista_ticket')->with(['title' => 'Lista Ticket / BuoniPasto','index' => '10']);
    }

    public function indexCasse(string $idcassa)
    {
        $result = [];
        try {
            $result['status'] = '200';
            $result['result'] = 'true';
            $result['items'] = Tickets::GetListCasse($idcassa); 
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
        $result['title'] = 'Gestione Tickets / Buoni Pasto';
        $tmp = Tickets::InserisciTicket($request);        
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];                        
        session()->flash('result',$result);        
        session()->put('lastid',$tmp['dati']->id);
        return view('users.anagrafica.lista_ticket')->with(['title' => 'Lista Ticket / BuoniPasto','index' => '10']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Tickets::show($id); 
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
        $result['title'] = 'Gestione Tickets / Buoni Pasto';
        $tmp = Tickets::ModificaTicket($request,$id);        
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result); 
        session()->put('lastid',$id);                       
        return view('users.anagrafica.lista_ticket')->with(['title' => 'Lista Ticket / BuoniPasto','index' => '10']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result['title'] = 'Gestione Tickets / Buoni Pasto';
        $tmp = Tickets::CancellaTicket($id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }
}
