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
        if (Casse::AggiornaBackend($idcassa) == '1'){
            $lastupdate = Casse::LastUpdate($idcassa);        
            if ( $lastupdate <> null )
            {
                return RListino::whereRaw("updated_at >= '".$lastupdate."' or updated_at is null")->get();
            } else 
            {
                return RListino::orderBy('codice')->get();
            }
        } else {
            return [];
        }    
    }

    static function GetPrezzi(string $id_articolo)
    {
        return RListino::where('r_listino.id_articolo',$id_articolo)
                        ->join('t_listino','t_listino.id','=','r_listino.id_listino')
                        ->selectRaw('r_listino.przlor as prezzo,t_listino.descrizione,t_listino.codice')
                        ->get();
    }
}
