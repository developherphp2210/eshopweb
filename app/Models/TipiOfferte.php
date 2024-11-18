<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipiOfferte extends Model
{
    use HasFactory;

    protected $table = 'tipi_offerte';    

    protected $fillable = [
        'id',
        'id_deposito',
        'codice_Offerta',
        'descrizione',
        'applicabilita',
        'nrVolte',
        'tipo_Offerta',
        'offerta_Cumulativa',
        'soglia_Qta',
        'soglia_Ammontare',
        'soglia_Sbt',
        'esito',
        'data_Inizio',
        'data_Fine',
        'soglia_Bollino',
        'promo',
        'lunedi',
        'martedi',
        'mercoledi',
        'giovedi',
        'venerdi',
        'sabato',
        'domenica',
        'ora_Ini',
        'ora_Fine',
        'livello'
    ];

//     TIPI OFFERTA

//           "Ammontare a subtotale" Value="1"
//           "Ammontare ad articolo" Value="2"
//           "Percentuale a subtotale" Value="3"
//           "Percentuale ad articolo" Value="4"
//           "M x N" Value="5"
//           "Regalo articolo" Value="6"
//           "Bollino" Value="7"
//           "Coupon" Value="8"
//           "Fascia prezzo cliente privilegiato" "9"
//           "Percentuale gruppo articoli" Value="10"
//           "Ammontare gruppo articoli" Value="11"

//      Applicabilità

//          "Contigentata" Value="0"
//          "Una volta" Value="1"
//          "Più volte" Value="2"
//          "Continua" Value="3"
//          "N volte" Value="4"

//      Offerta cumulativa

//      "Si" Value="0"
//      "No" Value="1"
//      "Paniere" Value="3"


    static function GetListCasse($idcassa)
    {        
        $lastupdate = Casse::LastUpdate($idcassa);        
        if ( $lastupdate <> null )
        {
            return TipiOfferte::whereRaw("updated_at >= '".$lastupdate."' or updated_at is null")->get();
        } else 
        {
            return TipiOfferte::all();                                
        }        
    }
}
