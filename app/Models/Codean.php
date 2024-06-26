<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codean extends Model
{
    use HasFactory;

    protected $table = 'codean';

    protected $fillable = [
        'id',
        'id_articolo',
        'barcode',
        'descrizione',
        'prezzo_special'
    ];

    static function GetListCasse($idcassa)
    {
        $lastupdate = Casse::LastUpdate($idcassa);        
        if ( $lastupdate <> null )
        {
            return Codean::whereRaw("updated_at >= '".$lastupdate."' or updated_at is null")->get();
        } else 
        {
            return Codean::orderBy('codice')->get();
        }
    }
}
