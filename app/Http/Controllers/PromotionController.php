<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = session('user');
        $filepdf = Settings::GetMyFilePdf($user->id);
        session()->put('filepdf',$filepdf->filepdf);
        return view('users.promotions')->with(['title' => 'Gestione Volantino','user' => $user]);   
    }

    public function Upload(Request $request) {
        $user = session('user');        
        if ($request->delete == '1'){            
            Settings::DeleteMyFilePdf($user->id);
            session()->put('filepdf','');
        } else {        
            if( $request->hasFile('file') ) {
                $path = $request->file('file')->storeAs('pdf','promotion'.$user->id.'.'.$request->file->extension());
                Settings::SaveMyFilePdf($user->id,$path);
                session()->put('filepdf',$path);
            }        
        }
        return view('users.promotions')->with(['title' => 'Gestione Volantino','user' => $user]); 
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
        //
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
