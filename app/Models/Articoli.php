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
        'posizione',
        'id_iva',
        'attivo',
        'um'
    ];

    
    static function GetList()
    {
        return Articoli::selectRaw('articoli.id,articoli.codice,articoli.descrizione,reparti.descrizione as reparto,t_listino.descrizione as nomelist, r_listino.przlor, codean.barcode')
                        ->leftjoin('r_listino','r_listino.id_articolo','=','articoli.id')
                        ->join('t_listino','t_listino.id','=','r_listino.id_listino')
                        ->leftjoin('codean','codean.id_articolo','=','articoli.id')
                        ->join('reparti', 'articoli.id_reparto', '=' ,'reparti.id')
                        ->limit('100')                        
                        ->get();        
        
    }

    static function Ricerca($request){           
        $query = '';     
        if ($request->reparti != '0'){
            $query = 'articoli.id_reparto = '.$request->reparti;                        
        };         
        if ($request->codice != ''){
            $queryLike = " ( articoli.codice LIKE '%".$request->codice."%' or articoli.descrizione LIKE '%".$request->codice."%' or codean.barcode LIKE '%".$request->codice."%' )";
            if ($query != ''){
                $string = Articoli::whereRaw($queryLike)
                            ->whereRaw($query)
                            ->selectRaw('distinct articoli.codice, articoli.descrizione, reparti.descrizione as reparto,t_listino.descrizione as nomelist, r_listino.przlor, codean.barcode, articoli.id')
                            ->leftjoin('r_listino','r_listino.id_articolo','=','articoli.id')
                            ->join('t_listino','t_listino.id','=','r_listino.id_listino')
                            ->leftjoin('codean','codean.id_articolo','=','articoli.id')
                            ->join('reparti','reparti.id','=','articoli.id_reparto')->get();
            } else {
                $string = Articoli::whereRaw($queryLike)                             
                            ->selectRaw('distinct articoli.codice, articoli.descrizione, reparti.descrizione as reparto,t_listino.descrizione as nomelist, r_listino.przlor, codean.barcode, articoli.id')
                            ->leftjoin('r_listino','r_listino.id_articolo','=','articoli.id')
                            ->join('t_listino','t_listino.id','=','r_listino.id_listino')
                            ->leftjoin('codean','codean.id_articolo','=','articoli.id')
                            ->join('reparti','reparti.id','=','articoli.id_reparto')->get();
            }
        } else {
            if ($query != ''){
                $string = Articoli::whereRaw($query)
                            ->selectRaw('distinct articoli.codice, articoli.descrizione, reparti.descrizione as reparto,t_listino.descrizione as nomelist, r_listino.przlor, codean.barcode, articoli.id')
                            ->leftjoin('r_listino','r_listino.id_articolo','=','articoli.id')
                            ->join('t_listino','t_listino.id','=','r_listino.id_listino')
                            ->leftjoin('codean','codean.id_articolo','=','articoli.id')
                            ->join('reparti','reparti.id','=','articoli.id_reparto')->get();
            } else {
                $string = Articoli::selectRaw('distinct articoli.codice, articoli.descrizione, reparti.descrizione as reparto,t_listino.descrizione as nomelist, r_listino.przlor, codean.barcode, articoli.id')
                            ->leftjoin('r_listino','r_listino.id_articolo','=','articoli.id')
                            ->join('t_listino','t_listino.id','=','r_listino.id_listino')
                            ->leftjoin('codean','codean.id_articolo','=','articoli.id')
                            ->join('reparti','reparti.id','=','articoli.id_reparto')->get();
            }
        }                         
        return $string;                
    }

    static function GetSingleArticle($id)
    {
        $article = Articoli::where('articoli.id',$id)
                            ->join('reparti','articoli.id_reparto','=','reparti.id')
                            ->join('iva','articoli.id_iva','=','iva.id')                                                        
                            ->select('articoli.id','articoli.codice as codart','articoli.descrizione','reparti.codice as codrep' ,'reparti.descrizione as desrep','iva.codice as codiva' ,'iva.descrizione as desiva')
                            ->first();
        return $article;
    }

    static function GetArticleTransaction($id)
    {
       $trans = Articoli::where('articoli.id',$id)
                        ->join('corpo_scontrino','corpo_scontrino.id_articolo','=','articoli.id')
                        ->join('testata_scontrino','testata_scontrino.id','=','corpo_scontrino.id_testata') 
                        ->join('casse','casse.id','=','testata_scontrino.id_cassa')
                        ->join('deposito','deposito.id','=','testata_scontrino.id_deposito')
                        ->leftjoin('clienti','clienti.id','=','testata_scontrino.id_cliente')
                        ->join('operatori','operatori.id','=','testata_scontrino.id_operatore')
                        ->selectRaw('casse.descrizione as cassa , deposito.descrizione as deposito,clienti.codice as cliente , operatori.descrizione AS cassiere , corpo_scontrino.quantita,corpo_scontrino.prezzo_lordo,(corpo_scontrino.sconto_art + corpo_scontrino.sconto_tra) as sconto  ,testata_scontrino.data ,testata_scontrino.numero_scontrino' )
                        ->get();
        return $trans;                
    }

    static function GetListCasse($idcassa)
    {
        if (Casse::AggiornaBackend($idcassa) == '1'){
            $lastupdate = Casse::LastUpdate($idcassa);        
            if ( $lastupdate <> null )
            {
                return Articoli::whereRaw("attivo = 1 and ( updated_at >= '".$lastupdate."' or updated_at is null)")->get();
            } else 
            {
                return Articoli::where('attivo','1')->orderBy('codice')->get();
            }
        } else {
            return [];
        }    
    }
}
