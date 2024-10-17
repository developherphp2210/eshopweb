<?php

namespace App\Models;

use App\Http\Controllers\CasseController;
use App\MyClass\MyLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class Casse extends Model
{
    use HasFactory;

    protected $table = 'casse';

    protected $fillable = [
        'id', 
        'id_deposito',
        'codice',
        'descrizione',
        'aggiorna_backend',
        'aggiorna_frontend',
        'lastupdate'
    ];

    static function GetList()
    {
        return Casse::orderBy('casse.codice')
                    ->join('deposito','deposito.id','=','casse.id_deposito')
                    ->selectRaw('casse.id, casse.id_deposito,casse.codice , casse.descrizione , deposito.descrizione as deposito, deposito.codice as codep')
                    ->get();
    }

    static function GetName($id_cassa){
        return Casse::where('id',$id_cassa)
                    ->select('descrizione')
                    ->first();
    }

    static function GetCassa($idcassa)
    {
        return Casse::where('casse.id',$idcassa)
                    ->join('deposito','deposito.id','=','casse.id_deposito')
                    ->selectRaw('casse.id, casse.id_deposito,casse.codice , casse.descrizione , deposito.descrizione as deposito, deposito.codice as codep, deposito.id_listino')
                    ->get();
    }

    static function InserimentoCasse($data)
    {
        $result = [];
        try {            
            Casse::create([                    
                'codice' => $data->codice,
                'descrizione' => $data->descrizione, 
                'id_deposito' => $data->id_deposito               
                              
            ]);              
            $result['message'] = 'Cassa Creata Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function AggiornaCasse($data,$id)
    {
        $result = [];
        try {                    
            Casse::where('id',$id)->update([
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,                
                'id_deposito' => $data->id_deposito
            ]);               
            $result['message'] = 'Cassa Aggiornata Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function CancellaCasse(string $id)
    {
        $result = [];
        try {
            Casse::where('id',$id)->delete();            
            $result['message'] = 'Cassa Cancellata!!';
            $result['error'] = 'false';
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),'0');
        }
        return $result;
    }

    static function Show($id)
    {
        return Casse::where('id',$id)->first();
    }

    static function check($codcassa,$codep)
    {
        return Casse::where('casse.codice',$codcassa)
              ->where('deposito.codice',$codep)
              ->join('deposito','deposito.id','=','casse.id_deposito')            
              ->selectRaw('casse.id , casse.aggiorna_backend, casse.aggiorna_frontend')
              ->first();
    }

    static function LastUpdate($id)
    {
        $tmp = Casse::where('id',$id)->select('lastupdate')->first();
        return $tmp['lastupdate'];
    }

    static function AggiornaBackend($id)
    {
        $tmp = Casse::where('id',$id)->select('aggiorna_backend')->first();
        return $tmp['aggiorna_backend'];
    }

    static function CloseRequest($idcassa)
    {
        Casse::where('id',$idcassa)->update([
            'aggiorna_backend' => 0,
            'aggiorna_frontend' =>0,
            'lastupdate' => Date::now()
        ]);
    }

    static function GetId($codice,$iddeposito)
    {
        return Casse::where('codice',$codice)->where('id_deposito',$iddeposito)->select('id')->first();
    }

    static function UpdateCasse():void
    {
        DB::table('casse')->update(['aggiorna_frontend' => 1]);
    }
}
