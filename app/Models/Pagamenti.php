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
        'descrizione',
        'tipologia',
        'codice_sdi',
        'tipo_rt',
        'attivo'
    ];

    static function GetList()
    {
        return Pagamenti::orderby('id')->get();
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
                'descrizione' => $data->descrizione,                               
                'attivo' => ($data->attivo == 'on') ? '1' : '0',
                'tipologia' => $data->tipologia,
                'tipo_rt' => $data->tipo_rt,
                'codice_sdi' => $data->codice_sdi
                
            ]); 
            Casse::UpdateCasse();  
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
                'descrizione' => $data->descrizione,                               
                'attivo' => ($data->attivo == 'on') ? '1' : '0',
                'tipologia' => $data->tipologia,
                'tipo_rt' => $data->tipo_rt,
                'codice_sdi' => $data->codice_sdi                
            ]);   
            $result['message'] = 'Pagamento Modificato Correttamente';
            $result['error'] = 'false'; 
            Casse::UpdateCasse();            
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
            return Pagamenti::whereRaw("attivo = 1 and ( updated_at >= '".$lastupdate."' or updated_at is null)")->get();
        } else 
        {
            return Pagamenti::where('attivo','1')->orderBy('id')->get();
        }
    }
}
