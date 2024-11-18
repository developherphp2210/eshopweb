<?php

namespace App\Models;

use App\MyClass\MyLog;
use App\Models\Casse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promozioni';

    protected $fillable = [
        'id',        
        'id_deposito',
        'descrizione',
        'data_inizio',
        'data_fine'
    ];

    static function GetList()
    {
        return Promo::all();
    }

    static function Show($id)
    {
        return Promo::where('id',$id)->first();
    }

    static function InserimentoPromozioni($data)
    {
        $result = [];
        try {            
            Promo::create([                                    
                'descrizione' => $data->descrizione,                
                'data_inizio' => $data->data_inizio,
                'data_fine' => $data->data_fine,
                'id_deposito' => $data->id_deposito                
            ]);  
            Casse::UpdateCasse();            
            $result['message'] = 'Promo Creata Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function AggiornaPromozioni($data,$id)
    {
        $result = [];
        try {                    
            Promo::where('id',$id)->update([
                'descrizione' => $data->descrizione,                
                'data_inizio' => $data->data_inizio,
                'data_fine' => $data->data_fine,
                'id_deposito' => $data->id_deposito    
            ]);   
            Casse::UpdateCasse();            
            $result['message'] = 'Promo Aggiornata Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function CancellaPromozioni(string $id)
    {
        $result = [];
        try {
            Promo::where('id',$id)->delete();            
            $result['message'] = 'Promo Cancellata!!';
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
            return Promo::whereRaw("updated_at >= '".$lastupdate."' or updated_at is null")->get();
        } else 
        {
            return Promo::all();
        }           
    }
}
