<?php

namespace App\Models;

use App\MyClass\MyLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaFidelity extends Model
{
    use HasFactory;

    protected $table = 'lineafidelity';

    protected $fillable=[
        'id',
        'attivo',
        'codice',
        'descrizione',
        'generati'
    ];

    static function GetList()
    {
        return LineaFidelity::all();
    }

    static function LineaSingola($id)
    {
        return LineaFidelity::where('id',$id)->first();
    }

    static function LineaFidInsert($data)
    {
        $result = [];
        try {            
            LineaFidelity::create([                    
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,                
                'attivo' => ($data->attivo == 'on') ? '1' : '0'
            ]);                         
            $result['message'] = 'Linea Fidelity Creata Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function Show($id)
    {
        return LineaFidelity::where('id',$id)->first();
    }

    static function LineaFidUpdate($data,$id)
    {
        $result = [];
        try {                    
            LineaFidelity::where('id',$id)->update([
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,                
                'attivo' => ($data->attivo == 'on') ? '1' : '0',                                                
            ]);                         
            $result['message'] = 'Lista Fidelity Aggiornata Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function LineaFidDelete(string $id)
    {
        $result = [];
        try {
            LineaFidelity::where('id',$id)->delete();            
            $result['message'] = 'Linea Fidelity Cancellata!!';
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
        if (Casse::AggiornaBackend($idcassa) == '1'){
            $lastupdate = Casse::LastUpdate($idcassa);        
            if ( $lastupdate <> null )
            {
                return LineaFidelity::whereRaw("updated_at >= '".$lastupdate."' or updated_at is null")->get();
            } else 
            {
                return LineaFidelity::orderBy('codice')->get();
            }
        } else {
            return [];
        }    
    }
}
