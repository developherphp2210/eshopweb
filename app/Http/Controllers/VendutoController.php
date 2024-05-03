<?php

namespace App\Http\Controllers;

use App\Models\CorpoScontrino;
use App\Models\PagamentiScontrino;
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
