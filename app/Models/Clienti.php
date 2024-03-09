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
        'user_id',
        'codice_fidelity',
        'ragsoc',
        'indirizzo',
        'cap',
        'citta',
        'prov',
        'tel',
        'codfisc',
        'email',
        'punti',
        'totale_vendita',
        'data_ultimo_scontrino',
        'cel'  
    ];

    static function InserimentoClienti($request):void
    {
        Clienti::updateorCreate(
            ['codice_fidelity' => $request->codcli],
            ['ragsoc' => $request->ragsoc, 
            'indirizzo' => $request->indirizzo,
            'cap' => $request->cap,
            'citta' => $request->citta,
            'prov' => $request->prov,
            'tel' => $request->tel,
            'cel' => $request->cel,
            'codfisc' => $request->codfisc,
            'email' => $request->emailcli,
            'punti' => $request->punti,
            'totale_vendita' => str_replace(',','.',$request->totven),
            'data_ultimo_scontrino' => $request->dataultimosco <> null ? str_replace('/','.',$request->dataultimosco) : null]
        );
    }

    static function GetList()
    {
        return Clienti::get();
    }

    static function GetCustomerId($request):string
    {
        $Clienti = Clienti::where('codice_fidelity',$request->codcli)->first();                    
        return $Clienti <> null ? $Clienti->id : '0';
    }

    static function GetSingleCustomer($id)
    {
        return Clienti::where('id',$id)->first();
    }

    static function GetCustomerTransaction($id)
    {
       $trans = Clienti::where('clienti.id',$id)                        
                        ->join('testata_scontrino','testata_scontrino.id_cliente','=','clienti.id') 
                        ->join('casse','casse.id','=','testata_scontrino.id_cassa')
                        ->join('deposito','deposito.id','=','testata_scontrino.id_deposito')                        
                        ->join('operatori','operatori.id','=','testata_scontrino.id_operatore')
                        ->select('casse.descrizione as cassa','deposito.descrizione as deposito','operatori.descrizione AS cassiere' , 'testata_scontrino.importo','testata_scontrino.data' ,'testata_scontrino.numero_scontrino','testata_scontrino.id' )
                        ->get();
        return $trans;                
    }
}
