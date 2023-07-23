<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vat;
use Illuminate\Http\Request;

class VatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = session('user');

        $vats = Vat::where('user_id',$user->id)->orderBy('code')->get();
        return view('users.registry.vats_list')->with(['title' => 'Lista Aliquote Iva','user' => $user, 'vats' => $vats]);
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
        Vat::InsertVat($request);
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
