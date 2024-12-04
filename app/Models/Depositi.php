<?php

namespace App\Models;

use App\MyClass\MyLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depositi extends Model
{
    use HasFactory;

    protected $table = 'deposito';

    protected $fillable = [
        'id',        
        'codice',
        'descrizione',
        'id_listino',
        'riga1',
        'riga2',
        'riga3',
        'riga4',
        'riga5',
        'riga6'
    ];
    

    static function GetList()
    {
        return Depositi::orderBy('codice')->get();
    }

    static function GetName($id_deposito){
        return Depositi::where('id',$id_deposito)
                    ->select('descrizione')
                    ->first();
    }

    static function Show($id)
    {
        return Depositi::where('id',$id)->first();
    }

    static function GetId($codice)
    {
        return Depositi::where('codice',$codice)->select('id')->first();
    }

    static function AggiornaDeposito($data,$id)
    {
        $result = [];
        try {                    
            Depositi::where('id',$id)->update([
                'riga1' => $data->riga1,
                'riga2' => $data->riga2,
                'riga3' => $data->riga3,
                'riga4' => $data->riga4,
                'riga5' => $data->riga5,
                'riga6' => $data->riga6
            ]);               
            $result['message'] = 'Intestazione Deposito Aggiornata';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }
    
}
