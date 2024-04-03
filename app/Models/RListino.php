<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RListino extends Model
{
    use HasFactory;

    protected $table = 'r_listino';

    protected $fillable = [
        'id',        
        'id_listino',
        'id_articolo',
        'przlor',
        'sconto1',
        'sconto2',
        'sconto3'
    ];

    static function GetListCasse($idcassa)
    {
        $lastupdate = Casse::LastUpdate($idcassa);        
        if ( $lastupdate <> null )
        {
            return RListino::whereRaw("updated_at >= '".$lastupdate."' or updated_at is null")->get();
        } else 
        {
            return RListino::orderBy('codice')->get();
        }
    }
}
