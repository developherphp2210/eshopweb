<?php

namespace App\Http\Controllers;


use App\Models\TransactionHeader;
use App\Models\User;

use App\Models\TransactionBody;
use App\Models\TransactionCausal;
use App\Models\TransactionDiscount;
use App\Models\TransactionPayment;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

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
        switch ($request->tiporiga) {
            case 'I':{
                return TransactionHeader::InsertTransactionHeader($request);
                break;
            }
            case 'A':{
                return $request->codart <> null  ? TransactionBody::InsertTransactionBody($request) : TransactionDiscount::InsertTransactionDiscount($request,'O');
                break;
            }
            case 'R':{
                return TransactionBody::InsertTransactionBody($request);
                break;
            }  
            case 'T':{
                return TransactionPayment::InsertTransactionPayment($request);
                break;
            }
            case 'E':{
                return TransactionCausal::InsertTransactionCausal($request);
                break;
            }
            case 'U':{
                return TransactionCausal::InsertTransactionCausal($request);
                break;
            }
            case 'S':{
                return TransactionDiscount::InsertTransactionDiscount($request,'S');
                break;
            }                       
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $type,string $data,string $id,string $shoptill)
    {
        $newdata = new DateTime($data);
        switch ($type) {
            case '1':
                return TransactionHeader::Last10Days($newdata,$id,$shoptill);
                break;
            case '2':
                return TransactionBody::Top10Departments($newdata,$id,$shoptill);
                break;
            case '3': 
                return TransactionPayment::Payments($newdata,$id,$shoptill);                           
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
