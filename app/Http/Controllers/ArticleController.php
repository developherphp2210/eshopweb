<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Codean;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = session('user');

        $articles = Article::GetArticleList($user->id);
        return view('users.registry.articles_list')->with(['title' => 'Lista Articoli','user' => $user, 'articles' => $articles]);
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
        $user = session('user');
        $article = Article::GetSingleArticle($id); 
        if ($page === '1'){
            $codean = Codean::GetCodeanList($id);        
            return view('users.registry.articleform')->with(['title' => 'Scheda Articolo',
                                                              'page' => $page ,
                                                              'user' => $user,
                                                              'articles' => $article,
                                                              'codeans' => $codean]);
        } else {
            $ledger = Article::GetArticleTransaction($id); 
            return view('users.registry.articleform')->with(['title' => 'Scheda Articolo',
                                                              'page' => $page ,
                                                              'user' => $user,
                                                              'articles' => $article,
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
