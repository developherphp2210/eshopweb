<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profili;

class ProfiloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $listaprofili = Profili::GetList();
        return view('users.anagrafica.lista_profili')->with(['title' => 'Lista Profili','index' => '7', 'listaprofili' => $listaprofili]);
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
        $result['title'] = 'Gestione Profili';
        $tmp = Profili::InserimentoProfili($request);
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
        return Profili::Show($id);
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
        $result['title'] = 'Gestione Profili';
        $tmp = Profili::AggiornaProfili($request,$id);
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
        $result['title'] = 'Gestione Profili';
        $tmp = Profili::ProfiliDelete($id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }
}
