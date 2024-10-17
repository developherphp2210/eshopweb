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
        if (Casse::AggiornaBackend($idcassa) == '1'){
            $lastupdate = Casse::LastUpdate($idcassa);        
            if ( $lastupdate <> null )
            {
                return Codean::whereRaw("updated_at >= '".$lastupdate."' or updated_at is null")->get();
            } else 
            {
                return Codean::orderBy('codice')->get();
            }
        } else {
            return [];
        }    
    }

    static function GetListEan(string $id_articolo)
    {
        return Codean::where('id_articolo',$id_articolo)->get();
    }
}
