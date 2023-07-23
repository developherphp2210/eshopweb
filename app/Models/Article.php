<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'id',
        'user_id',
        'code',
        'description',
        'department_id',
        'price'
    ];

    static function GetArticleId($request,$department_id,$vat_id){
        $article = Article::updateorCreate(
            ['user_id'=> $request->user_id,'code' => $request->codart],
            ['department_id' => $department_id,
            'description' => utf8_encode($request->desean),
            'price' => str_replace(',','.',$request->importo),
            'vat_id' => $vat_id]
        );
        return $article->id;
    }

    static function GetArticleList($userid)
    {
        return Article::where('articles.user_id',$userid)
                        ->join('departments', 'articles.department_id', '=' ,'departments.id')
                        ->select('articles.id','articles.code','articles.description','articles.price','departments.description as department')
                        ->get();        
        
    }

    static function GetSingleArticle($id)
    {
        $article = Article::where('articles.id',$id)
                            ->join('departments','articles.department_id','=','departments.id')
                            ->join('vats','articles.vat_id','=','vats.id')                            
                            ->select('articles.id','articles.code as codart','articles.description','articles.price','departments.code as codrep' ,'departments.description as desrep','vats.code as codiva' ,'vats.descriptions as desiva')
                            ->first();
        return $article;
    }

    static function GetArticleTransaction($id)
    {
       $trans = Article::where('articles.id',$id)
                        ->join('transaction_body','transaction_body.articles_id','=','articles.id')
                        ->join('transaction_header','transaction_header.id','=','transaction_body.transaction_id') 
                        ->join('tills','tills.id','=','transaction_header.till_id')
                        ->join('shops','shops.id','=','transaction_header.shop_id')
                        ->join('customers','customers.id','=','transaction_header.customer_id')
                        ->join('cashiers','cashiers.id','=','transaction_header.cashier_id')
                        ->select('tills.description as cassa','shops.description as deposito','customers.codice_fidelity as cliente' , 'cashiers.description AS cassiere' , 'transaction_body.quantity','transaction_body.price','transaction_body.discounts'  ,'transaction_header.data' ,'transaction_header.transaction_number' )
                        ->get();
        return $trans;                
    }
}
