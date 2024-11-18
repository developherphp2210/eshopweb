<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScontiScontrino extends Model
{
    use HasFactory;

    protected $table = 'sconti_scontrino';

    public $timestamps = false;

    protected $fillable = [
        'id_testata',
        'id_sconti',        
        'id_corpo',
        'importo'
    ];

    static function MemorizzoSconti($id,$idcorpo,$data)
    {
        ScontiScontrino::create([
            'id_testata' => $id,
            'id_corpo' => $idcorpo,
            'id_sconti' => $data[4],
            'importo' => str_replace(',','.',$data[5])
        ]);
    }

    static function MemorizzoScontiSbt($id,$data)
    {
        ScontiScontrino::create([
            'id_testata' => $id,
            'id_corpo' => 0,
            'id_sconti' => $data[2],
            'importo' => str_replace(',','.',$data[3])
        ]);
    }

    static function ListaTransazioni($idcassa,$iddeposito,$data)
    {
        return ScontiScontrino::where('testata_scontrino.id_deposito',$iddeposito)
                                ->where('testata_scontrino.id_cassa',$idcassa)
                                ->whereRaw(" DATE(testata_scontrino.data) = '".$data."'")
                                ->join('testata_scontrino','testata_scontrino.id','=','sconti_scontrino.id_testata')
                                ->selectRaw('sconti_scontrino.id_testata,sconti_scontrino.id_sconti,sconti_scontrino.importo,sconti_scontrino.id_corpo')
                                ->get();
    }

    static function SingolaTransazione($id)
    {
        return ScontiScontrino::where('sconti_scontrino.id_testata',$id)
                                ->join('sconti','sconti.id','=','sconti_scontrino.id_sconti')
                                ->selectRaw('sconti_scontrino.importo,sconti.descrizione,sconti_scontrino.id_corpo')
                                ->get();
    }
}
