<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articoli';

    protected $fillable = [
        'id',
        'codice',
        'descrizione',
        'des_breve',
        'logo',
        'id_reparto',        
        'tasto_rapido',
        'id_iva',
        'attivo'
    ];

    static function GetArticleId($request,$department_id,$vat_id){
        $article = Article::updateorCreate(
            ['code' => $request->codart],
            ['id_reparto' => $department_id,
            'descrizione' => mb_convert_encoding($request->desean,'UTF-8'),            
            'id_iva' => $vat_id]
        );
        return $article->id;
    }

    static function GetArticleList($userid)
    {
        return Article::select('articoli.id','articoli.codice','articoli.descrizione','reparti.descrizione as reparto')
                        ->join('reparti', 'articoli.id_reparto', '=' ,'reparti.id')                        
                        ->get();        
        
    }

    static function GetSingleArticle($id)
    {
        $article = Article::where('articoli.id',$id)
                            ->join('reparti','articoli.department_id','=','reparti.id')
                            ->join('iva','articoli.id_iva','=','iva.id')                            
                            ->select('articoli.id','articoli.codice as codart','articoli.descrizione','reparti.codice as codrep' ,'reparti.descrizione as desrep','iva.codice as codiva' ,'iva.descrizione as desiva')
                            ->first();
        return $article;
    }

    static function GetArticleTransaction($id)
    {
       $trans = Article::where('articoli.id',$id)
                        ->join('corpo_scontrino','corpo_scontrino.id_articolo','=','articoli.id')
                        ->join('testata_scontrino','testata_scontrino.id','=','corpo_scontrino.id_testata') 
                        ->join('casse','casse.id','=','testata_scontrino.id_cassa')
                        ->join('deposito','deposito.id','=','testata_scontrino.id_deposito')
                        ->join('clienti','clienti.id','=','testata_scontrino.id_clienti')
                        ->join('operatori','operatori.id','=','testata_scontrino.id_operatore')
                        ->select('casse.descrizione as cassa','deposito.descrizione as deposito','clienti.codice_fidelity as cliente' , 'operatori.descrizione AS cassiere' , 'testata_scontrino.quantita','testata_scontrino.importo','testata_scontrino.discounts'  ,'testata_scontrino.data' ,'testata_scontrino.numero_scontrino' )
                        ->get();
        return $trans;                
    }
}
