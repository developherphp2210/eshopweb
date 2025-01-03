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
        'prezzo_lordo',
        'presenza_sconto',
        'presenza_offerta',
        'quantita',
        'causale',
        'sconto_art',
        'sconto_tra'
    ];

    static function MemorizzoCorpo($id,$data)
    {
        $corpo = CorpoScontrino::create([
            'id_testata' => $id,
            'causale' => $data[1],
            'id_articolo' => $data[2],
            'id_codean' => $data[3],
            'prezzo_lordo' => ($data[1] == 'R') ? '-'.str_replace(',','.',$data[4]) : str_replace(',','.',$data[4]),
            'quantita' => $data[6],
            'id_reparto' => $data[7],
            'id_iva' => $data[8],
            'sconto_art' => str_replace(',','.',$data[5]),
            'sconto_tra' => str_replace(',','.',$data[9]),
            'presenza_sconto' => $data[10],
            'presenza_offerta' => $data[11]
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
                              ->selectRaw(' sum( (corpo_scontrino.prezzo_lordo * corpo_scontrino.quantita) - (corpo_scontrino.sconto_art + corpo_scontrino.sconto_tra)) as totale, reparti.descrizione ')
                              ->groupBy('reparti.descrizione')
                              ->orderByRaw('totale desc')
                              ->limit(10)
                              ->get();
    }

    private function QueryShop($data,$id_deposito){
        return CorpoScontrino::whereRaw(" date(testata_scontrino.data) = '".$data->format('Y-m-d')."' and testata_scontrino.id_deposito = ".$id_deposito)
                              ->join('testata_scontrino','testata_scontrino.id','=','corpo_scontrino.id_testata')
                              ->join('reparti','reparti.id','=','corpo_scontrino.id_reparto') 
                              ->selectRaw(' sum( (corpo_scontrino.prezzo_lordo * corpo_scontrino.quantita) - (corpo_scontrino.sconto_art + corpo_scontrino.sconto_tra)) as totale, reparti.descrizione ')
                              ->groupBy('reparti.descrizione')
                              ->orderByRaw('totale desc')
                              ->limit(10)
                              ->get();
    }

    private function QueryTill($data,$id_cassa){
        return CorpoScontrino::whereRaw("date(testata_scontrino.data) = '".$data->format('Y-m-d')."' and testata_scontrino.id_cassa = ".$id_cassa)
                              ->join('testata_scontrino','testata_scontrino.id','=','corpo_scontrino.id_testata')
                              ->join('reparti','reparti.id','=','corpo_scontrino.id_reparto') 
                              ->selectRaw(' sum( (corpo_scontrino.prezzo_lordo * corpo_scontrino.quantita) - (corpo_scontrino.sconto_art + corpo_scontrino.sconto_tra)) as totale, reparti.descrizione ')
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

    static function ListaTransazioni($idcassa,$iddeposito,$data)
    {
        return CorpoScontrino::where('testata_scontrino.id_deposito',$iddeposito)
                                ->where('testata_scontrino.id_cassa',$idcassa)
                                ->whereRaw(" DATE(testata_scontrino.data) = '".$data."'")
                                ->join('testata_scontrino','testata_scontrino.id','=','corpo_scontrino.id_testata')
                                ->selectRaw('corpo_scontrino.id,corpo_scontrino.id_testata,corpo_scontrino.id_articolo,corpo_scontrino.id_reparto,corpo_scontrino.id_iva,corpo_scontrino.id_codean,corpo_scontrino.prezzo_lordo,corpo_scontrino.presenza_sconto,corpo_scontrino.presenza_offerta,corpo_scontrino.quantita,corpo_scontrino.causale,(corpo_scontrino.sconto_art + corpo_scontrino.sconto_tra) as totsconti  ')
                                ->get();
    }

    static function SingolaTransazione($id)
    {
        return CorpoScontrino::where('corpo_scontrino.id_testata',$id)
                                ->join('articoli','articoli.id','=','corpo_scontrino.id_articolo')
                                ->join('iva','iva.id','=','corpo_scontrino.id_iva')
                                ->selectRaw('articoli.descrizione,corpo_scontrino.prezzo_lordo,corpo_scontrino.presenza_sconto,corpo_scontrino.quantita,corpo_scontrino.causale,corpo_scontrino.id')
                                ->get();
    }

    static function DettaglioIva($id)
    {
        return CorpoScontrino::where('corpo_scontrino.id_testata',$id)
                            ->join('articoli','articoli.id','=','corpo_scontrino.id_articolo')
                            ->join('iva','iva.id','=','corpo_scontrino.id_iva')
                            ->selectRaw(' sum(corpo_scontrino.prezzo_lordo * corpo_scontrino.quantita) - sum(corpo_scontrino.sconto_art + corpo_scontrino.sconto_tra) as importo,corpo_scontrino.id_iva,iva.aliquota,iva.descrizione ')
                            ->groupByRaw('corpo_scontrino.id_iva,iva.aliquota,iva.descrizione')
                            ->get();
    }
}
