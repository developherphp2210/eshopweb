<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CVolantino extends Model
{
    use HasFactory;

    protected $table = 'corpo_volantino';

    protected $fillable = [
        'id',  
        'id_testata',
        'id_articolo',
        'id_offerta',
        'prezzo_iniziale',
        'prezzo_offerta'
    ]; 

    static function GetListCasse($idcassa)
    {
        $lastupdate = Casse::LastUpdate($idcassa);        
        if ( $lastupdate <> null )
        {
            return CVolantino::whereRaw("testata_volantino.updated_at >= '".$lastupdate."' or testata_volantino.updated_at is null")
                            ->join('testata_volantino','testata_volantino.id','=','corpo_volantino.id_testata')
                            ->selectRaw('testata_volantino.data_inizio,testata_volantino.data_fine,corpo_volantino.id_testata,corpo_volantino.id_articolo,corpo_volantino.id_offerta,corpo_volantino.prezzo_iniziale,corpo_volantino.prezzo_offerta')
                            ->get();
        } else 
        {
            return CVolantino::whereRaw("testata_volantino.data_inizio <= '".now()."' and testata_volantino.data_fine >= '".now()."'")
                            ->join('testata_volantino','testata_volantino.id','=','corpo_volantino.id_testata')
                            ->selectRaw('testata_volantino.data_inizio,testata_volantino.data_fine,corpo_volantino.id_testata,corpo_volantino.id_articolo,corpo_volantino.id_offerta,corpo_volantino.prezzo_iniziale,corpo_volantino.prezzo_offerta')
                            ->get();
        }
    }
}
