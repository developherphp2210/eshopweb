<?php

namespace App\Models;

use App\MyClass\MyLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [

        'id',
        'attivo',
        'descrizione',
        'valore'
    ];

    static function GetList(){
        return Tickets::all();
    }

    static function Show($id)
    {
        return Tickets::where('id',$id)->first();
    }

    static function InserisciTicket($data)
    {
        $result = [];
        try {            
            $result['dati'] = Tickets::create([                                    
                'descrizione' => $data->descrizione,                               
                'attivo' => ($data->attivo == 'on') ? '1' : '0',
                'valore' => str_replace(',','.',$data->valore)                
            ]); 
            Casse::UpdateCasse();  
            $result['message'] = 'Ticket Inserito Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function ModificaTicket($data,$id)
    {
        $result = [];
        try {            
            Tickets::where('id',$id)->update([                                    
                'descrizione' => $data->descrizione,                               
                'attivo' => ($data->attivo == 'on') ? '1' : '0',
                'valore' => str_replace(',','.',$data->valore)
            ]);   
            $result['message'] = 'Ticket Modificato Correttamente';
            $result['error'] = 'false'; 
            Casse::UpdateCasse();            
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function CancellaTicket(string $id)
    {
        $result = [];
        try {
            Tickets::where('id',$id)->delete();            
            $result['message'] = 'Ticket Cancellato!!';
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
            return Tickets::whereRaw("attivo = 1 and ( updated_at >= '".$lastupdate."' or updated_at is null)")->get();
        } else 
        {
            return Tickets::where('attivo','1')->orderBy('id')->get();
        }
    }
}
