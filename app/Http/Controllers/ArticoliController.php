<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articoli;
use App\Models\Codean;
use App\Models\Reparti;
use App\Models\RListino;

class ArticoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $articoli['reparti'] = Reparti::GetList();
        $articoli['lista'] = Articoli::GetList();
        return view('users.anagrafica.lista_articoli')->with(['title' => 'Lista Articoli','index' => '3', 'articoli' => $articoli]);
    }

    public function ricerca(Request $request)
    {
        $articoli['reparti'] = Reparti::GetList();
        $articoli['lista'] = Articoli::Ricerca($request);
        $articoli['valori'] = [
            $request->codice,
            $request->reparti
        ];
        return view('users.anagrafica.lista_articoli')->with(['title' => 'Lista Articoli','index' => '3', 'articoli' => $articoli]);
    }

    public function indexCasse(string $idcassa)
    {
        $result = [];
        try {
            $result['status'] = '200';
            $result['result'] = 'true';
            $result['items'] = Articoli::GetListCasse($idcassa);;    
        } catch (\Throwable $th) {
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,string $page)
    {
        $articoli['articolo'] = Articoli::GetSingleArticle($id);
        if ($page == '1'){
            $articoli['ean'] = Codean::GetListEan($id);
            $articoli['prezzi'] = RListino::GetPrezzi($id);
        } else {
            $articoli['transazioni'] = Articoli::GetArticleTransaction($id);
        }
        return view('users.anagrafica.schedaArticolo')->with(['title' => 'Lista Articoli','index' => '3', 'listaArticolo' => $articoli,'page' => $page]);
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
