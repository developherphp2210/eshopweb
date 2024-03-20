<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\MyClass\MyLog;

class Pagamenti extends Model
{
    use HasFactory;

    protected $table = 'pagamenti';

    protected $fillable = [
        'id',        
        'codice',
        'descrizione',
        'tipologia',
        'codice_sdi',
        'tipo_rt',
        'attivo'
    ];

    static function GetList()
    {
        return Pagamenti::OrderBy('codice')->get();
    }

    static function Show($id)
    {
        return Pagamenti::where('id',$id)->first();
    }

    static function InserisciPagamento($data)
    {
        $result = [];
        try {            
            Pagamenti::create([                    
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,                               
                'attivo' => ($data->attivo == 'on') ? '1' : '0'
                
            ]);   
            $result['message'] = 'Pagamento Inserito Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function ModificaPagamento($data,$id)
    {
        $result = [];
        try {            
            Pagamenti::where('id',$id)->update([                    
                'codice' => $data->codice,
                'descrizione' => $data->descrizione,                               
                'attivo' => ($data->attivo == 'on') ? '1' : '0'                
            ]);   
            $result['message'] = 'Pagamento Modificato Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function CancellaPagamento(string $id)
    {
        $result = [];
        try {
            Pagamenti::where('id',$id)->delete();            
            $result['message'] = 'Pagamento Cancellato!!';
            $result['error'] = 'false';
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),'0');
        }
        return $result;
    }
}
