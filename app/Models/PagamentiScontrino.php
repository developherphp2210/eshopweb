<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagamentiScontrino extends Model
{
    use HasFactory;

    protected $table = 'pagamenti_scontrino';

    public $timestamps = false;

    protected $fillable = [
        'id_testata',
        'id_pagamenti',        
        'importo'
    ];

    static function MemorizzoPagamenti($id,$data)
    {
        PagamentiScontrino::create([
            'id_testata' => $id,
            'id_pagamenti' => $data[1],
            'importo' => str_replace(',','.',$data[2]),
        ]);
    }

    static function Pagamenti($data,$shoptill){
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
        return PagamentiScontrino::whereRaw(" date(testata_scontrino.data) = '".$data->format('Y-m-d')."'")
                                 ->join('testata_scontrino','testata_scontrino.id','=','pagamenti_scontrino.id_testata')
                                 ->join('pagamenti','pagamenti.id','=','pagamenti_scontrino.id_pagamenti') 
                                 ->selectRaw(' sum(pagamenti_scontrino.importo) as totale, pagamenti.descrizione ')
                                 ->groupBy('pagamenti.descrizione')
                                 ->orderByRaw('totale desc')
                                 ->limit(10)
                                 ->get();
    }

    private function QueryShop($data,$id_deposito){
        return PagamentiScontrino::whereRaw(" date(testata_scontrino.data) = '".$data->format('Y-m-d')."' and testata_scontrino.id_deposito = ".$id_deposito)
                                 ->join('testata_scontrino','testata_scontrino.id','=','pagamenti_scontrino.id_testata')
                                 ->join('pagamenti','pagamenti.id','=','pagamenti_scontrino.id_pagamenti') 
                                 ->selectRaw(' sum(pagamenti_scontrino.importo) as totale, pagamenti.descrizione ')
                                 ->groupBy('pagamenti.descrizione')
                                 ->orderByRaw('totale desc')
                                 ->limit(10)
                                 ->get();
    }

    private function QueryTill($data,$id_cassa){
        return PagamentiScontrino::whereRaw(" date(testata_scontrino.data) = '".$data->format('Y-m-d')."' and testata_scontrino.id_cassa = ".$id_cassa)
                                 ->join('testata_scontrino','testata_scontrino.id','=','pagamenti_scontrino.id_testata')
                                 ->join('pagamenti','pagamenti.id','=','pagamenti_scontrino.id_pagamenti') 
                                 ->selectRaw(' sum(pagamenti_scontrino.importo) as totale, pagamenti.descrizione ')
                                 ->groupBy('pagamenti.descrizione')
                                 ->orderByRaw('totale desc')
                                 ->limit(10)
                                 ->get();
    }

    static function ListaTransazioni($idcassa,$iddeposito,$data)
    {
        return PagamentiScontrino::where('testata_scontrino.id_deposito',$iddeposito)
                                ->where('testata_scontrino.id_cassa',$idcassa)
                                ->whereRaw(" DATE(testata_scontrino.data) = '".$data."'")
                                ->join('testata_scontrino','testata_scontrino.id','=','pagamenti_scontrino.id_testata')
                                ->selectRaw('pagamenti_scontrino.id_testata,pagamenti_scontrino.id_pagamenti,pagamenti_scontrino.importo')
                                ->get();
    }

    static function SingolaTransazione($id)
    {
        return PagamentiScontrino::where('pagamenti_scontrino.id_testata',$id)
                                    ->join('pagamenti','pagamenti.id','=','pagamenti_scontrino.id_pagamenti')
                                    ->selectRaw('pagamenti_scontrino.importo,pagamenti.descrizione')
                                    ->get();
    }
}
