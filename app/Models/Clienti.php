<?php

namespace App\Models;

use App\MyClass\MyLog;
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
        'id_listino',
        'ideshop'
    ];
    
    static function GetList()
    {
        return Clienti::leftjoin('fidelity_clienti','fidelity_clienti.id_cliente','=','clienti.id')
                        ->leftjoin('fidelity_card','fidelity_card.id','=','fidelity_clienti.id_fidelity')
                        ->leftjoin('puntipromo','puntipromo.id_fidelity','=','fidelity_card.id')
                        ->selectRaw('clienti.id,clienti.ragsoc,puntipromo.punti,fidelity_card.saldo,clienti.totale_vendita,fidelity_card.codice')
                        ->get();
    }

    // static function GetCustomerId($request):string
    // {
    //     $Clienti = Clienti::where('codice_fidelity',$request->codcli)->first();                    
    //     return $Clienti <> null ? $Clienti->id : '0';
    // }

    static function GetCliente($id)
    {
        return Clienti::where('id',$id)->first();
    }

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

    static function ClienteUpdate($data,$id)
    {
        $result = [];
        try {            
            Clienti::where('id',$id)->update([                    
                'ragsoc' => $data->ragsoc,        
                'indirizzo' => $data->indirizzo,
                'cap' => $data->cap,
                'citta' => $data->citta,
                'prov' => $data->prov,
                'tel' => $data->tel,
                'cel' => $data->cel,
                'codfisc' => $data->codfisc,        
                'email' => $data->email
            ]);   
            $result['message'] = 'Cliente Fidelity Aggiornato Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }
}
