<?php

namespace App\Models;

use App\MyClass\MyLog;
use App\MyClass\Utility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FidelityCard extends Model
{
    use HasFactory;

    protected $table = 'fidelity_card';

    protected $fillable=[
        'id',
        'id_linea',
        'codice',
        'descrizione',
        'livello',
        'punti',
        'saldo',
        'id_listino'
    ];

    static function GetList()
    {
        return FidelityCard::all();
    }

    static function GenrazioneFidelity($data,$id)
    {
        $result = [];        
        try {            
            $linea = LineaFidelity::LineaSingola($id);              
            for ($i=$data->codini; $i <= $data->codfin; $i++) { 
                $fid = FidelityCard::create([
                    'id_linea' => $id,
                    'codice' => (new self)->CreaTessera($linea->codice,$i),
                    'descrizione' => $data->descrizione,
                    'livello' => $data->livello,
                    'id_listino' => $data->idlistino
                ]);
                if ($data->gencli == 'on'){
                    $cli = Clienti::create([
                        'ragsoc' => 'CLIENTE FIDELITY',
                        'codice' => $i
                    ]);
                    FidelityClienti::create([
                        'id_cliente' => $cli->id,
                        'id_fidelity' => $fid->id
                    ]);
                }
            } 
            Casse::UpdateCasse();                        
            $result['message'] = 'Codici Fidelity Generati Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    private function CreaTessera($codicefisso,$codice)
    {
        if ($codice < 10){            
            $prog = '0000'.$codice;                        
            return Utility::ean13_check_digit($codicefisso.$prog);            
        }
        if ($codice < 100){
            $prog = '000'.$codice;
            return Utility::ean13_check_digit($codicefisso . $prog);            
        }
        if ($codice < 1000){
            $prog = '00'.$codice;
            return Utility::ean13_check_digit($codicefisso . $prog);            
        }
        if ($codice < 10000){
            $prog = '0'.$codice;
            return Utility::ean13_check_digit($codicefisso . $prog);            
        }    
    }

    static function GetListNoClient()    
    {
        $lista = DB::table('fidelity_clienti')->select('id_fidelity')->get();
        foreach($lista as $lis)
        {
            $data[] = $lis->id_fidelity;
        }                
        return FidelityCard::select('codice','punti')->whereNotIn('id', $data )->get();               
    }

    
}
