<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\MyClass\MyLog;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Cassieri extends Model
{
    use HasFactory;

    protected $table = 'operatori';

    protected $fillable = [
        'id',        
        'codice',
        'descrizione',
        'password',
        'barcode',
        'attivo',
        'visibile_cassa',
        'visibile_frontend',
        'id_profilo'
    ];

    static function GetList()
    {
        return Cassieri::selectRaw('operatori.visibile_cassa ,operatori.visibile_frontend, operatori.attivo,operatori.codice,operatori.descrizione,operatori.id,profili.descrizione as profilo,operatori.password,operatori.barcode,operatori.id_profilo')
                        ->join('profili','profili.id','=','operatori.id_profilo')               
                        ->orderBy('operatori.codice') 
                        ->get();
    }

    static function Show($id)
    {
        return Cassieri::where('id',$id)->first();
    }

    static function InserimentoCassieri($data)
    {
        $result = [];
        try {            
            $cassiere = Cassieri::create([                    
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,
                'password' => $data->password,                
                'attivo' => ($data->attivo == 'on') ? '1' : '0',                
                'barcode' => $data->barcode, 
                'visibile_cassa' => ($data->visibile_cassa == 'on') ? '1' : '0',   
                'visibile_frontend' => ($data->visibile_frontend == 'on') ? '1' : '0',   
                'id_profilo' => $data->id_profilo                
            ]);  
            if ($data->visibile_frontend == 'on'){
                User::create([
                    'user_name' => $data->descrizione,
                    'password' => Hash::make($data->password),
                    'id_operatore' => $cassiere->id,
                    'primo_accesso' => 1
                ]);
            }
            Casse::UpdateCasse();
            $result['message'] = 'Cassiere Creato Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function AggiornaCassieri($data,$id)
    {
        $result = [];
        try {        
            $cassiere = Cassieri::where('id',$id)->first();
            $dati = [
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,
                'password' => $data->password,                
                'attivo' => ($data->attivo == 'on') ? '1' : '0',                
                'barcode' => $data->barcode,    
                'visibile_cassa' => ($data->visibile_cassa == 'on') ? '1' : '0',                   
                'id_profilo' => $data->id_profilo 
            ];
            if ($cassiere->visibile_frontend == 0)
            {
                if ($data->visibile_frontend == 'on'){
                    User::create([
                        'user_name' => $data->descrizione,
                        'password' => Hash::make($data->password),
                        'id_operatore' => $cassiere->id,
                        'primo_accesso' => 1
                    ]);
                }
                $dati['visibile_frontend'] = ($data->visibile_frontend == 'on') ? '1' : '0';
            } else {
                
                User::where('id_operatore',$id)->update([
                    'user_name' => $data->descrizione
                ]);
            }
            Cassieri::where('id',$id)->update($dati);  
            Casse::UpdateCasse();             
            $result['message'] = 'Cassiere Aggiornato Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function CassieriDelete(string $id)
    {
        $result = [];
        try {
            Cassieri::where('id',$id)->delete();            
            $result['message'] = 'Cassiere Cancellato!!';
            $result['error'] = 'false';
            Casse::UpdateCasse();
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),'0');
        }
        return $result;
    }

    static function GetListCasse($idcassa)
    {
        $lastupdate = Casse::LastUpdate($idcassa);        
        if ( $lastupdate <> null )
        {
            return Cassieri::whereRaw("visibile_cassa = 1 and ( updated_at >= '".$lastupdate."' or updated_at is null)")->get();
        } else 
        {
            return Cassieri::where('visibile_cassa','1')->orderBy('codice')->get();
        }
    }
    
}
