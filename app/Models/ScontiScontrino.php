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
}
