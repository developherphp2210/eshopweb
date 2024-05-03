<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clienti extends Model
{
    use HasFactory;

    /**
     * 
     * @var string
     * 
     */
    
     protected $table = 'clienti';

     protected $fillable=[
        'id',
        'codice',
        'ragsoc',
        'ragsoc1',
        'indirizzo',
        'cap',
        'citta',
        'prov',
        'tel',
        'codfisc',
        'piva',
        'email',
        'punti',
        'totale_vendita',
        'data_ultimo_scontrino',
        'cel',
        'pec',
        'sdi',
        'ipa',
        'split',
        'id_listino'
    ];
    
    static function GetList()
    {
        return Clienti::get();
    }

    // static function GetCustomerId($request):string
    // {
    //     $Clienti = Clienti::where('codice_fidelity',$request->codcli)->first();                    
    //     return $Clienti <> null ? $Clienti->id : '0';
    // }

    // static function GetSingleCustomer($id)
    // {
    //     return Clienti::where('id',$id)->first();
    // }

    // static function GetCustomerTransaction($id)
    // {
    //    $trans = Clienti::where('clienti.id',$id)                        
    //                     ->join('testata_scontrino','testata_scontrino.id_cliente','=','clienti.id') 
    //                     ->join('casse','casse.id','=','testata_scontrino.id_cassa')
    //                     ->join('deposito','deposito.id','=','testata_scontrino.id_deposito')                        
    //                     ->join('operatori','operatori.id','=','testata_scontrino.id_operatore')
    //                     ->select('casse.descrizione as cassa','deposito.descrizione as deposito','operatori.descrizione AS cassiere' , 'testata_scontrino.importo','testata_scontrino.data' ,'testata_scontrino.numero_scontrino','testata_scontrino.id' )
    //                     ->get();
    //     return $trans;                
    // }

    static function GetListCasse($idcassa)
    {
        $lastupdate = Casse::LastUpdate($idcassa);        
        if ( $lastupdate <> null )
        {
            return Clienti::whereRaw("updated_at >= '".$lastupdate."' or updated_at is null")->get();
        } else 
        {
            return Clienti::orderBy('codice')->get();
        }
    }

    
}
