<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\MyClass\MyLog;

class Sconti extends Model
{
    use HasFactory;

    protected $table = 'sconti';

    protected $fillable = [
        'id',        
        'descrizione',
        'tipo',
        'valore',
        'attivo'
    ];

    static function GetList()
    {
        return Sconti::whereRaw('id > 2')->OrderBy('id')->get();
    }

    static function Show($id)
    {
        return Sconti::where('id',$id)->first();
    }

    static function InserisciSconto($data)
    {
        $result = [];
        try {            
            $result['dati'] = Sconti::create([                                 
                'descrizione' => $data->descrizione,                               
                'attivo' => ($data->attivo == 'on') ? '1' : '0',
                'valore' => $data->valore,
                'tipo' => $data->tipo
            ]); 
            Casse::UpdateCasse();  
            $result['message'] = 'Sconto Inserito Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function ModificaSconto($data,$id)
    {
        $result = [];
        try {            
            Sconti::where('id',$id)->update([                                    
                'descrizione' => $data->descrizione,                               
                'attivo' => ($data->attivo == 'on') ? '1' : '0',
                'valore' => $data->valore,
                'tipo' => $data->tipo
            ]);   
            Casse::UpdateCasse();
            $result['message'] = 'Sconto Modificato Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function CancellaSconto(string $id)
    {
        $result = [];
        try {
            Sconti::where('id',$id)->delete();            
            $result['message'] = 'Sconto Cancellato!!';
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
            return Sconti::whereRaw("attivo = 1 and ( updated_at >= '".$lastupdate."' or updated_at is null)")->get();
        } else 
        {
            return Sconti::where('attivo','1')->orderBy('id')->get();
        }
    }
}
