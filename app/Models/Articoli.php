<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articoli extends Model
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

    
    static function GetList()
    {
        return Articoli::select('articoli.id','articoli.codice','articoli.descrizione','reparti.descrizione as reparto')
                        ->join('reparti', 'articoli.id_reparto', '=' ,'reparti.id')
                        ->limit('10000')                        
                        ->get();        
        
    }

    // static function GetSingleArticle($id)
    // {
    //     $article = Articoli::where('articoli.id',$id)
    //                         ->join('reparti','articoli.department_id','=','reparti.id')
    //                         ->join('iva','articoli.id_iva','=','iva.id')                            
    //                         ->select('articoli.id','articoli.codice as codart','articoli.descrizione','reparti.codice as codrep' ,'reparti.descrizione as desrep','iva.codice as codiva' ,'iva.descrizione as desiva')
    //                         ->first();
    //     return $article;
    // }

    // static function GetArticleTransaction($id)
    // {
    //    $trans = Articoli::where('articoli.id',$id)
    //                     ->join('corpo_scontrino','corpo_scontrino.id_articolo','=','articoli.id')
    //                     ->join('testata_scontrino','testata_scontrino.id','=','corpo_scontrino.id_testata') 
    //                     ->join('casse','casse.id','=','testata_scontrino.id_cassa')
    //                     ->join('deposito','deposito.id','=','testata_scontrino.id_deposito')
    //                     ->join('clienti','clienti.id','=','testata_scontrino.id_clienti')
    //                     ->join('operatori','operatori.id','=','testata_scontrino.id_operatore')
    //                     ->select('casse.descrizione as cassa','deposito.descrizione as deposito','clienti.codice_fidelity as cliente' , 'operatori.descrizione AS cassiere' , 'testata_scontrino.quantita','testata_scontrino.importo','testata_scontrino.discounts'  ,'testata_scontrino.data' ,'testata_scontrino.numero_scontrino' )
    //                     ->get();
    //     return $trans;                
    // }

    static function GetListCasse($idcassa)
    {
        $lastupdate = Casse::LastUpdate($idcassa);        
        if ( $lastupdate <> null )
        {
            return Articoli::whereRaw("attivo = 1 and ( updated_at >= '".$lastupdate."' or updated_at is null)")->get();
        } else 
        {
            return Articoli::where('attivo','1')->orderBy('codice')->get();
        }
    }
}
