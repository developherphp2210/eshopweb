<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TListino extends Model
{
    use HasFactory;

    protected $table = 't_listino';

    protected $fillable = [
        'id',        
        'codice',
        'descrizione'
    ];

    static function GetList()
    {
        return TListino::orderby('codice')->get();
    }

    static function GetListCasse($idcassa)
    {
        if (Casse::AggiornaBackend($idcassa) == '1'){
            $lastupdate = Casse::LastUpdate($idcassa);        
            if ( $lastupdate <> null )
            {
                return TListino::whereRaw("updated_at >= '".$lastupdate."' or updated_at is null")->get();
            } else 
            {
                return TListino::orderBy('codice')->get();
            }
        } else {
            return [];
        }    
    }
}
