<?php

namespace App\Http\Controllers;

use App\Models\CorpoScontrino;
use App\Models\PagamentiScontrino;
use App\Models\TestataScontrino;
use App\Models\TransactionBody;
use App\Models\TransactionPayment;
use DateTime;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
