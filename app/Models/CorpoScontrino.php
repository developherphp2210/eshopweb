<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorpoScontrino extends Model
{
    use HasFactory;

    protected $table = 'corpo_scontrino';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_testata',
        'id_articolo',
        'id_reparto',
        'id_iva',
        'id_codean',
        'prezzo',
        'presenza_sconto',
        'quantita',
        'causale'
    ];

    static function MemorizzoCorpo($id,$data)
    {
        $corpo = CorpoScontrino::create([
            'id_testata' => $id,
            'causale' => $data[1],
            'id_articolo' => $data[2],
            'id_codean' => $data[3],
            'prezzo' => ($data[6] < 0) ? '-'.str_replace(',','.',$data[4]) : str_replace(',','.',$data[4]),
            'quantita' => $data[6],
            'id_reparto' => $data[7],
            'id_iva' => $data[8]
        ]);

        return $corpo['id'];
    }

    static function Top10Reparti($data,$shoptill){
        if ($shoptill != '0'){
            $id = substr($shoptill,5,strlen($shoptill)-5);
            switch (substr($shoptill,0,4)) {
                case 'shop':
                    return (new self)->QueryShop($data,$id);
                    break;
                
                case 'till':
                    return (new self)->QueryTill($data,$id);
                    break;                
            }
        } else {
            return (new self)->QueryNoShopTill($data);
        }
    }

    private function QueryNoShopTill($data){
        return CorpoScontrino::whereRaw(" date(testata_scontrino.data) = '".$data->format('Y-m-d')."'")
                              ->join('testata_scontrino','testata_scontrino.id','=','corpo_scontrino.id_testata')
                              ->join('reparti','reparti.id','=','corpo_scontrino.id_reparto') 
                              ->selectRaw(' sum( corpo_scontrino.prezzo * corpo_scontrino.quantita) as totale, reparti.descrizione ')
                              ->groupBy('reparti.descrizione')
                              ->orderByRaw('totale desc')
                              ->limit(10)
                              ->get();
    }

    private function QueryShop($data,$id_deposito){
        return CorpoScontrino::whereRaw(" date(testata_scontrino.data) = '".$data->format('Y-m-d')."' and testata_scontrino.id_deposito = ".$id_deposito)
                              ->join('testata_scontrino','testata_scontrino.id','=','corpo_scontrino.id_testata')
                              ->join('reparti','reparti.id','=','corpo_scontrino.id_reparto') 
                              ->selectRaw(' sum( corpo_scontrino.prezzo * corpo_scontrino.quantita) as totale, reparti.descrizione ')
                              ->groupBy('reparti.descrizione')
                              ->orderByRaw('totale desc')
                              ->limit(10)
                              ->get();
    }

    private function QueryTill($data,$id_cassa){
        return CorpoScontrino::whereRaw("date(testata_scontrino.data) = '".$data->format('Y-m-d')."' and testata_scontrino.id_cassa = ".$id_cassa)
                              ->join('testata_scontrino','testata_scontrino.id','=','corpo_scontrino.id_testata')
                              ->join('reparti','reparti.id','=','corpo_scontrino.id_reparto') 
                              ->selectRaw(' sum( corpo_scontrino.prezzo * corpo_scontrino.quantita )   as totale, reparti.descrizione ')
                              ->groupBy('reparti.descrizione')
                              ->orderByRaw('totale desc')
                              ->limit(10)
                              ->get();
    }

    static function SingleReceipt($id){
        return CorpoScontrino::where('transaction_header.id',$id)
                               ->join('transaction_header','transaction_header.id','=','transaction_body.transaction_id')  
                               ->join('articles','articles.id','=','transaction_body.articles_id')
                               ->selectRaw('transaction_body.price,transaction_body.quantity,transaction_body.type,articles.description AS articolo,(transaction_body.price * transaction_body.quantity) AS totale,transaction_body.discounts')
                               ->get();
    }
}
