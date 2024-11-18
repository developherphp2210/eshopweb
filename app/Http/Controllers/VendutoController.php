<?php

namespace App\Http\Controllers;

use App\Models\Casse;
use App\Models\Causali;
use App\Models\Clienti;
use App\Models\CorpoScontrino;
use App\Models\Depositi;
use App\Models\FidelityScontrino;
use App\Models\Iva;
use App\Models\MovimentiVerpre;
use App\Models\PagamentiScontrino;
use App\Models\Puntipromo;
use App\Models\ScontiScontrino;
use App\Models\TestataScontrino;
use App\MyClass\MyLog;
use App\MyClass\Utility;
use Illuminate\Http\Request;

class VendutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            $result['status'] = '200';
            $result['result'] = 'true';
            $id = 0;
            $idcorpo = 0;
            foreach ($request->all() as $value) {                
                $data = str_getcsv($value,'|');
                MyLog::WriteLog($value,1);
                switch ($data[0]) {
                    case 'V': MovimentiVerpre::InsertMovimentiVerpre($data);
                    case 'T':                        
                        if ($data[1] == 'S') {
                            ScontiScontrino::MemorizzoScontiSbt($id,$data);
                        } else {                            
                            $id = TestataScontrino::MemorizzaTestata($data);                            
                        }
                        break;
                    case 'C':
                        if ($data[1] == 'S') {
                            ScontiScontrino::MemorizzoSconti($id,$idcorpo,$data);
                        } else {
                            $idcorpo = CorpoScontrino::MemorizzoCorpo($id,$data);
                        }
                        break;
                    case 'P':
                        PagamentiScontrino::MemorizzoPagamenti($id,$data);
                        break;
                    case 'F':
                        FidelityScontrino::MemorizzoFidelity($id,$data);
                        Puntipromo::InserisciPunti($data[2],$data[1],($data[4] + $data[5]));
                        break;                            
                }                
            }                            
        } catch (\Throwable $th) {
            if ($id <> 0) 
            {
                TestataScontrino::CancelloTestata($id);
            } 
            $result['status'] = '400';
            $result['result'] = 'false';
            MyLog::WriteLog($th->getMessage(),0);
            $result['error'] = $th->getMessage();
        }                
        return $result;      

    }

    /**
     * Display the specified resource.
     */
    public function show(string $cassa,string $deposito,string $data)
    {
        try 
        {
            $iddeposito = Depositi::GetId($deposito)['id'];
            $idcassa = Casse::GetId($cassa,$iddeposito)['id']; 
            $result['status'] = '200';
            $result['result'] = 'true';      
            $result['testata'] = TestataScontrino::ListaTransazioni($idcassa,$iddeposito,$data);
            $result['fidelity'] = FidelityScontrino::ListaTransazioni($idcassa,$iddeposito,$data);
            $result['corpo'] = CorpoScontrino::ListaTransazioni($idcassa,$iddeposito,$data);
            $result['sconti'] = ScontiScontrino::ListaTransazioni($idcassa,$iddeposito,$data);
            $result['pagamenti'] = PagamentiScontrino::ListaTransazioni($idcassa,$iddeposito,$data);
        } catch (\Throwable $th) {        
            $result['status'] = '400';
            $result['result'] = 'false';
            MyLog::WriteLog($th->getMessage(),0);
            $result['error'] = $th->getMessage();
        }
        return $result;

    }

    public function showsingle(string $id)
    {
        $result['testata'] = TestataScontrino::SingolaTransazione($id);
        $result['fidelity'] = FidelityScontrino::Singolatransazione($id);
        $result['corpo'] = CorpoScontrino::SingolaTransazione($id);
        $result['sconti'] = ScontiScontrino::SingolaTransazione($id);
        $result['pagamenti'] = PagamentiScontrino::SingolaTransazione($id);
        return $result;
    }

    public function showsingleFat(string $id)
    {
        $result['testata'] = TestataScontrino::SingolaFattura($id);
        $result['cliente'] = Clienti::GetCliente($result['testata']['id_cliente']);
        $result['corpo'] = CorpoScontrino::SingolaTransazione($id);
        $result['sconti'] = ScontiScontrino::SingolaTransazione($id);
        $result['pagamenti'] = PagamentiScontrino::SingolaTransazione($id);
        $result['iva'] = CorpoScontrino::DettaglioIva($id);
        return $result;
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
