<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EListino extends Model
{
    use HasFactory;

    protected $table = 'e_listino';

    protected $fillable = [
        'id',        
        'id_rlistino',
        'id_ean',
        'przlor',
        'sconto1',
        'sconto2',
        'sconto3'
    ];

    static function GetListCasse($idcassa)
    {
        if (Casse::AggiornaBackend($idcassa) == '1'){
            $lastupdate = Casse::LastUpdate($idcassa);        
            if ( $lastupdate <> null )
            {
                return EListino::whereRaw("updated_at >= '".$lastupdate."' or updated_at is null")->get();
            } else 
            {
                return EListino::orderBy('codice')->get();
            }
        } else {
            return [];
        }    
    }

    
}
