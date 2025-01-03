<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferteScontrino extends Model
{
    use HasFactory;

    protected $table = 'offerte_scontrino';

    public $timestamps = false;

    protected $fillable = [
        'id_testata',
        'id_offerta',        
        'id_corpo',
        'importo'
    ];

    static function MemorizzoOfferte($id,$idcorpo,$data)
    {
        OfferteScontrino::create([
            'id_testata' => $id,
            'id_corpo' => $idcorpo,
            'id_offerta' => $data[4],
            'importo' => str_replace(',','.',$data[5])
        ]);
    }

    static function ListaTransazioni($idcassa,$iddeposito,$data)
    {
        return OfferteScontrino::where('testata_scontrino.id_deposito',$iddeposito)
                                ->where('testata_scontrino.id_cassa',$idcassa)
                                ->whereRaw(" DATE(testata_scontrino.data) = '".$data."'")
                                ->join('testata_scontrino','testata_scontrino.id','=','offerte_scontrino.id_testata')
                                ->selectRaw('offerte_scontrino.id_testata,offerte_scontrino.id_offerta,offerte_scontrino.importo,offerte_scontrino.id_corpo')
                                ->get();
    }

    static function SingolaTransazione($id)
    {
        return OfferteScontrino::where('offerte_scontrino.id_testata',$id)
                                ->join('tipi_offerte','tipi_offerte.id','=','offerte_scontrino.id_offerta')
                                ->selectRaw('offerte_scontrino.importo,tipi_offerte.descrizione,offerte_scontrino.id_corpo')
                                ->get();
    }
}
