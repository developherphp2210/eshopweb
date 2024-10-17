<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\MyClass\MyLog;

class Profili extends Model
{
    use HasFactory;

    protected $table = 'profili';

    protected $fillable = [
        'id',        
        'descrizione',
        'versamenti',
        'prelievi',
        'richiama_scontrino',
        'sconti',
        'correzioni',
        'annulla_scontrino',
        'reso',        
        'preconto',
        'gestione_fiscale',
        'rapporti',
        'scarico',
        'fattura',
        'scontrino',
        'dashboard',
        'cassieri',
        'anagrafiche',
        'stampa_addestramenti'
    ];

    static function GetNameList()
    {
        return Profili::select('descrizione','id')->OrderBy('id')->get();
    }

    static function GetList()
    {
        return Profili::orderBy('descrizione')->get();
    }

    static function InserimentoProfili($data)
    {
        $result = [];
        try {            
            Profili::create([                                    
                'descrizione' => $data->descrizione,                
            ]);   
            Casse::UpdateCasse();
            $result['message'] = 'Profilo Creato Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function AggiornaProfili($data,$id)
    {
        $result = [];
        try {            
            Profili::where('id',$id)->update([                                    
                'descrizione' => $data->descrizione,                        
                'dashboard' => ($data->dashboard == 'on') ? '1' : '0',   
                'anagrafiche' => ($data->anagrafiche == 'on') ? '1' : '0',   
                'cassieri' => ($data->cassieri == 'on') ? '1' : '0',

                'versamenti' => ($data->versamenti == 'on') ? '1' : '0',   
                'prelievi' => ($data->prelievi == 'on') ? '1' : '0',   
                'richiama_scontrino' => ($data->richiama_scontrino == 'on') ? '1' : '0',
                'sconti' => ($data->sconti == 'on') ? '1' : '0',   
                'correzioni' => ($data->correzioni == 'on') ? '1' : '0',   
                'annulla_scontrino' => ($data->annulla_scontrino == 'on') ? '1' : '0',
                'reso' => ($data->reso == 'on') ? '1' : '0',   
                'preconto' => ($data->preconto == 'on') ? '1' : '0',   
                'gestione_fiscale' => ($data->gestione_fiscale == 'on') ? '1' : '0',

                'rapporti' => ($data->rapporti == 'on') ? '1' : '0',
                'scarico' => ($data->scarico == 'on') ? '1' : '0',   
                'fattura' => ($data->fattura == 'on') ? '1' : '0',   
                'scontrino' => ($data->scontrino == 'on') ? '1' : '0',
                'stampa_addestramenti' => ($data->stampa_addestramenti == 'on') ? '1' : '0'
            ]);   
            Casse::UpdateCasse();
            $result['message'] = 'Profilo Aggiornato Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function ProfiliDelete(string $id)
    {
        $result = [];
        try {
            Profili::where('id',$id)->delete();            
            $result['message'] = 'Profilo Cancellato!!';
            $result['error'] = 'false';
            Casse::UpdateCasse();
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),'0');
        }
        return $result;
    }

    static function Show($id)
    {
        return Profili::where('id',$id)->first();
    }

    static function GetListCasse($idcassa)
    {
        $lastupdate = Casse::LastUpdate($idcassa);        
        if ( $lastupdate <> null )
        {
            return Profili::whereRaw(" updated_at >= '".$lastupdate."' or updated_at is null")->get();
        } else 
        {
            return Profili::orderBy('codice')->get();
        }
    }
}
