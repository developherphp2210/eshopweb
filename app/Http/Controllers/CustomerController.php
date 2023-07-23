<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Settings;
use App\Models\TransactionBody;
use App\Models\TransactionDiscount;
use App\Models\TransactionHeader;
use App\Models\TransactionPayment;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = session('user');

        $customers = Customer::where('user_id',$user->id)->get();
        return view('users.registry.customers_list')->with(['title' => 'Lista Clienti Fidelity','user' => $user, 'customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function receipt(string $id){
        $user = session('user');        
        $receipt['setting'] = Settings::GetMySetting($user->id);        
        $receipt['header'] = TransactionHeader::GetMyTransaction($id);
        $receipt['body'] = TransactionBody::SingleReceipt($id);
        $receipt['payment'] = TransactionPayment::SingleReceipt($id);
        $receipt['discount'] =  TransactionDiscount::SingleReceipt($id);
        return view('users.registry.receipt')->with(['title' => 'Scontrino','user' => $user,'receipt' => $receipt]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        Customer::InsertCustomer($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,string $page)
    {
        $user = session('user');
        $customer = Customer::GetSingleCustomer($id);
        if ($page === '1'){
            return view('users.registry.customerform')->with(['title' => 'Anagrafica Cliente',
                                                              'page' => $page ,
                                                              'user' => $user,
                                                              'customer' => $customer]);
        } else {
            $ledger = Customer::GetCustomerTransaction($id);
            return view('users.registry.customerform')->with(['title' => 'Anagrafica Cliente',
                                                              'page' => $page ,
                                                              'user' => $user,
                                                              'customer' => $customer,
                                                              'ledgers' => $ledger]);
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
