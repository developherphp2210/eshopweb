<?php

namespace App\Http\Controllers;

use App\Models\Casse;
use App\Models\CorpoScontrino;
use App\Models\Depositi;
use App\Models\PagamentiScontrino;
use App\Models\TestataScontrino;
use App\Models\TransactionBody;
use App\Models\TransactionPayment;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = new DateTime('now');
        $transazioni['lista'] = TestataScontrino::ListaTransazioni('0','0',$data->format('Y-m-d'));
        $transazioni['data'] = $data->format('Y-m-d');
        $transazioni['depositi'] = Depositi::GetList();
        $transazioni['default_dep'] = '0';
        return view('users.lista_transazioni')->with(['title' => 'Lista Transazioni','index' => '101','transazioni' => $transazioni]);
    }

    public function filtri(Request $request)
    {
        $data = new DateTime($request->data);        
        $transazioni['lista'] = TestataScontrino::ListaTransazioni($request->casse,$request->depositi,$data->format('Y-m-d'));
        $transazioni['data'] = $data->format('Y-m-d');
        $transazioni['depositi'] = Depositi::GetList();
        $transazioni['default_dep'] = $request->depositi;
        if ($request->depositi != '0'){
            $transazioni['casse'] = Casse::CasseDeposito($request->depositi);
            $transazioni['default_casse'] = $request->casse;            
        }
       
        return view('users.lista_transazioni')->with(['title' => 'Lista Transazioni','index' => '101','transazioni' => $transazioni]);
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
        
    }

    public function annulloScontrino(string $id,$operid)
    {
        return TestataScontrino::AnnulloScontrino($id,$operid);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $type,string $data,string $shoptill)
    {
        $newdata = new DateTime($data);
        switch ($type) {
            case '1':
                return TestataScontrino::Last10Days($newdata,$shoptill);
                break;
            case '2':
                return CorpoScontrino::Top10Reparti($newdata,$shoptill);
                break;
            case '3': 
                return PagamentiScontrino::Pagamenti($newdata,$shoptill);                           
                break;
        }        
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
