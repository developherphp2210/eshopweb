<?php

namespace App\Http\Controllers;

use App\Models\Casse;
use App\Models\Depositi;
use Illuminate\Http\Request;

class CasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $casse['casse'] = Casse::GetList();  
        $casse['deposito'] = Depositi::GetList();
        return view('users.barriera.lista_casse')->with(['title' => 'Lista Casse','index' => '22', 'listacasse' => $casse]);
    }

    public function check(string $codcassa,string $codep)
    {
        try{
            $item = Casse::check($codcassa,$codep);                        
            if ($item['aggiorna'] == '1')
            {
                $result['status'] = '200';
                $result['result'] = 'true';
                $result['idcassa'] = $item['id'];
            } else 
            {
                $result['status'] = '200';
                $result['result'] = 'false';
            }
        } catch (\Throwable $th) {
            $result['status'] = '400';
            $result['result'] = 'false';
            $result['error'] = $th->getMessage();
        }
        return $result;
    }

    public function CloseRequest(string $idcassa)
    {
        try{
            Casse::CloseRequest($idcassa);
            $result['status'] = '200';
            $result['result'] = 'true';
        } catch (\Throwable $th){
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
        $result['title'] = 'Gestione Casse';
        $tmp = Casse::InserimentoCasse($request);
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
        return Casse::Show($id);
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
        $result['title'] = 'Gestione Casse';
        $tmp = Casse::AggiornaCasse($request,$id);
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
        $result['title'] = 'Gestione Casse';
        $tmp = Casse::CancellaCasse($id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }
}
