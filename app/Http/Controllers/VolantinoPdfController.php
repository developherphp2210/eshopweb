<?php

namespace App\Http\Controllers;

use App\Models\VolantinoPdf;
use Illuminate\Http\Request;

class VolantinoPdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.volantini.lista_volantinipdf')->with(['title' => 'Lista Volantini PDF','index' => '40']);
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
        $result['title'] = 'Gestione Volantino PDF';
        $tmp =  VolantinoPdf::VolantinoPDFInsert($request);
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
        $volantino = VolantinoPdf::Show($id);
        return view('users.volantini.mostra_volantinopdf')->with(['title' => $volantino->nome,'index' => '40','volantino' => $volantino]);
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
        $result['title'] = 'Gestione Volantino PDF';
        $tmp =  VolantinoPdf::VolantinoPDFDelete($id);
        $result['message'] = $tmp['message'];
        $result['error'] = $tmp['error'];
        session()->flash('result',$result);        
        return redirect()->back();
    }
}
