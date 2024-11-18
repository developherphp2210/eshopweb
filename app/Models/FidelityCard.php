<?php

namespace App\Models;

use App\MyClass\MyLog;
use App\MyClass\Utility;
use App\Models\Casse;
use App\Models\LineaFidelity;
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
        'saldo'        
    ];

    static function GetList()
    {
        return FidelityCard::all();
    }

    static function GetListClienti($id)
    {
        return FidelityCard::where('fidelity_clienti.id_cliente',$id)
                            ->join('fidelity_clienti','fidelity_clienti.id_fidelity','=','fidelity_card.id')
                            ->leftjoin('puntipromo','puntipromo.id_fidelity','=','fidelity_card.id')
                            ->selectRaw('fidelity_card.codice,fidelity_card.descrizione,puntipromo.punti,fidelity_card.saldo')
                            ->get();
    }

    static function GenrazioneFidelity($data,$id)
    {
        $result = [];        
        try {            
            $linea = LineaFidelity::LineaSingola($id);   
            $count = 0;           
            for ($i=$data->codini; $i <= $data->codfin; $i++) { 
                $fid = FidelityCard::create([
                    'id_linea' => $id,
                    'codice' => (new self)->CreaTessera($linea->codice,$i),
                    'descrizione' => $data->descrizione,
                    'livello' => $data->livello,                    
                ]);
                if ($data->gencli == 'on'){
                    $cli = Clienti::create([
                        'ragsoc' => 'CLIENTE FIDELITY',
                        'codice' => $i,
                        'id_listino' => $data->idlistino
                    ]);
                    FidelityClienti::create([
                        'id_cliente' => $cli->id,
                        'id_fidelity' => $fid->id
                    ]);                    
                }
                $count++;
            } 
            $count = $count + $linea->generati;
            LineaFidelity::where('id',$linea->id)->update(['generati' => $count]);
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
        if (strlen($codice) < 2){            
            $prog = '0000'.$codice;                        
            return Utility::ean13_check_digit($codicefisso.$prog);            
        }
        if (strlen($codice) < 3){
            $prog = '000'.$codice;
            return Utility::ean13_check_digit($codicefisso . $prog);            
        }
        if (strlen($codice) < 4){
            $prog = '00'.$codice;
            return Utility::ean13_check_digit($codicefisso . $prog);            
        }
        if (strlen($codice) < 5){
            $prog = '0'.$codice;
            return Utility::ean13_check_digit($codicefisso . $prog);            
        }    
        return Utility::ean13_check_digit($codicefisso . $codice);
    }

    static function GetListNoClient()    
    {
        $lista = DB::table('fidelity_clienti')->select('id_fidelity')->get();
        $data[] = '';
        foreach($lista as $lis)
        {
            $data[] = $lis->id_fidelity;
        }                
        return FidelityCard::select('codice','punti','id')->whereNotIn('id', $data )->get();               
    }

    static function GetListCasse($idcassa)
    {        
        $lastupdate = Casse::LastUpdate($idcassa);        
        if ( $lastupdate <> null )
        {
            return FidelityCard::whereRaw("fidelity_card.updated_at >= '".$lastupdate."' or fidelity_card.updated_at is null")
                                ->leftjoin('fidelity_clienti','fidelity_clienti.id_fidelity','=','fidelity_card.id')
                                ->selectRaw('fidelity_card.id,fidelity_card.codice,fidelity_card.descrizione,fidelity_card.id_linea,fidelity_card.livello,fidelity_clienti.id_cliente')
                                ->get();
        } else 
        {
            return FidelityCard::orderBy('codice')
                                ->leftjoin('fidelity_clienti','fidelity_clienti.id_fidelity','=','fidelity_card.id')
                                ->selectRaw('fidelity_card.id,fidelity_card.codice,fidelity_card.descrizione,fidelity_card.id_linea,fidelity_card.livello,fidelity_clienti.id_cliente')
                                ->get();
        }        
    }

    static function TotalePunti($iduser)
    {
        return FidelityCard::where('fidelity_clienti.id_cliente',$iduser)
                            ->join('fidelity_clienti','fidelity_clienti.id_fidelity','=','fidelity_card.id')
                            ->leftjoin('puntipromo','puntipromo.id_fidelity','=','fidelity_card.id')
                            ->sum('puntipromo.punti');
    }

    static function TotalePrepagata($iduser)
    {
        return FidelityCard::where('fidelity_clienti.id_cliente',$iduser)
                            ->join('fidelity_clienti','fidelity_clienti.id_fidelity','=','fidelity_card.id')
                            ->sum('fidelity_card.saldo');
    }

    static function FidelityClienti($data)
    {
        $result = [];
        try {
            FidelityClienti::create([
                'id_cliente' => $data->clienteid,
                'id_fidelity' => $data->fidelityid
            ]);
            FidelityCard::where('id',$data->fidelityid)->update([
                'updated_at' => now()
            ]);
            $result['message'] = 'Tessera Associata Correttamente';
            $result['error'] = 'false';
            Casse::UpdateCasse();
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),'0');
        }
        return $result;
    }  
    
    
}
