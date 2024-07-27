<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\MyClass\MyLog;

class Reparti extends Model
{
    use HasFactory;

    protected $table = 'reparti';

    protected $fillable=[
        'id',        
        'codice',
        'descrizione',
        'posizione'
    ];

    static function GetList()
    {
        return Reparti::orderBy('codice')->get();
    }

    static function Show($id)
    {
        return Reparti::where('id',$id)->first();
    }

    static function InserimentoReparto($data)
    {
        $result = [];
        try {            
            Reparti::create([                    
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,
                'posizione' => ($data->visibile == 'on') ? '1' : '0',                
                'attivo' => ($data->attivo == 'on') ? '1' : '0'
            ]);   
            $result['message'] = 'Reparto Creato Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function RepartoUpdate($data,$id)
    {
        $result = [];
        try {            
            Reparti::where('id',$id)->update([                    
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,
                'posizione' => ($data->visibile == 'on') ? '1' : '0',
                'attivo' => ($data->attivo == 'on') ? '1' : '0'
            ]);   
            $result['message'] = 'Reparto Aggiornato Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function RepartoDelete(string $id)
    {
        $result = [];
        try {
            Reparti::where('id',$id)->delete();            
            $result['message'] = 'Reparto Cancellato!!';
            $result['error'] = 'false';
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
            return Reparti::whereRaw(" updated_at >= '".$lastupdate."' or updated_at is null")->get();
        } else 
        {
            return Reparti::orderBy('codice')->get();
        }
    }
}
