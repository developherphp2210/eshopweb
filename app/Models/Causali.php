<?php

namespace App\Models;

use App\MyClass\MyLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Causali extends Model
{
    use HasFactory;

    protected $table = 'causali_verpre';

    protected $fillable = [
        'id',   
        'attivo' ,
        'codice',
        'descrizione',
        'type'
    ];

    static function GetList()
    {
        return Causali::orderby('codice')->get();
    }

    static function Show($id)
    {
        return Causali::where('id',$id)->first();
    }

    static function InserimentoCausali($data)
    {
        $result = [];
        try {            
            Causali::create([                    
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,                
                'attivo' => ($data->attivo == 'on') ? '1' : '0',                                
                'type' => $data->type                
            ]);  
            Casse::UpdateCasse();            
            $result['message'] = 'Causale Creata Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function AggiornaCausali($data,$id)
    {
        $result = [];
        try {                    
            Causali::where('id',$id)->update([
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,                
                'attivo' => ($data->attivo == 'on') ? '1' : '0',                                
                'type' => $data->type  
            ]);   
            Casse::UpdateCasse();            
            $result['message'] = 'Causale Aggiornata Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function CancellaCausali(string $id)
    {
        $result = [];
        try {
            Causali::where('id',$id)->delete();            
            $result['message'] = 'Causale Cancellata!!';
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
            return Causali::whereRaw("attivo = 1 and ( updated_at >= '".$lastupdate."' or updated_at is null)")->get();
        } else 
        {
            return Causali::where('attivo','1')->orderBy('codice')->get();
        }           
    }

    static function GetId($codice)
    {
        return Causali::where('codice',$codice)->select('id')->first();
    }
    
    
}
