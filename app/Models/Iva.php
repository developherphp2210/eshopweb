<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\MyClass\MyLog;

class Iva extends Model
{
    use HasFactory;

    protected $table = 'iva';

    protected $fillable = [
        'id',
        'codice',
        'descrizione',
        'aliquota',
        'reparto_fiscale',
        'attivo'
    ];
    
    static function GetList()
    {
        return Iva::orderBy('codice')->get();
    }

    static function SingleIva(string $id)
    {
        return Iva::where('id',$id)->first();
    }

    static function IvaUpdate($data,$id)
    {
        $result = [];
        try {            
            Iva::where('id',$id)->update([                    
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,
                'aliquota' => $data->aliquota,
                'reparto_fiscale' => $data->reparto_fiscale,
                'attivo' => ($data->attivo == 'on') ? '1' : '0'
            ]);   
            $result['message'] = 'Aliquota IVA Aggiornata Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function InserimentoIva($data)
    {
        $result = [];
        try {            
            Iva::create([                    
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,
                'aliquota' => $data->aliquota,
                'reparto_fiscale' => $data->reparto_fiscale,
                'attivo' => ($data->attivo == 'on') ? '1' : '0'
            ]);   
            $result['message'] = 'Aliquota IVA Creata Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function IvaDelete(string $id)
    {
        $result = [];
        try {
            Iva::where('id',$id)->delete();            
            $result['message'] = 'Aliquota IVA Cancellata!!';
            $result['error'] = 'false';
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),'0');
        }
        return $result;
    }

}
