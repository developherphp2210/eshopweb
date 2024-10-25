<?php

namespace App\Models;

use App\MyClass\MyLog;
use App\MyClass\Utility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class TestataScontrino extends Model
{
    use HasFactory;

    protected $table = 'testata_scontrino';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_deposito',
        'id_cassa',
        'id_cliente',
        'id_operatore',
        'importo',
        'data',
        'numero_scontrino',
        'punti',
        'punti_jolly',
        'causale_documento',
        'numero_chiusura',
        'matricola_fiscale',
        'sconto_art',
        'sconto_tra',
        'numero_fattura',
        'registro_fattura',
        'riferimento_scontrino',
        'scontrino_annullato',
        'data_annullo',
        'operatore_annullo',
        'rileva_venduto'
    ];

    static function MemorizzaTestata($data)
    {
        $iddeposito = Depositi::GetId($data[5])['id'];
        $testata = TestataScontrino::create([
            'id_deposito' => $iddeposito,
            'id_cassa' => Casse::GetId($data[6],$iddeposito)['id'],
            'id_cliente' => ($data[4] <> '') ? $data[4] : '0',
            'id_operatore' => $data[3],
            'data' => Utility::ConverTimestamp($data[2]),
            'causale_documento' => $data[1],
            'importo' => str_replace(',','.',$data[7]),
            'sconto_art' => str_replace(',','.',$data[8]),
            'sconto_tra' => str_replace(',','.',$data[9]),
            'numero_scontrino' => $data[10],
            'numero_chiusura' => $data[11],
            'matricola_fiscale' => $data[12],
            'numero_fattura' => ($data[13] <> '') ? $data[13] : 0,
            'registro_fattura' => $data[14],
            'riferimento_scontrino' => ($data[15] <> '') ? $data[15] : 0              
        ]);
        return $testata['id'];
    }

    static function CancelloTestata($id)
    {
        TestataScontrino::where('id',$id)->delete();
    }

    public static function TotaleGiorno($data,$id_deposito,$id_cassa): array
    {                              
        if (($id_deposito === 0) && ($id_cassa === 0)){
            $total[0] = TestataScontrino::whereBetween('data', [(new self)->DataIni($data->format('Y-m-d H:i:s')),(new self)->DataFin($data->format('Y-m-d H:i:s'))])->sum('importo');                                                            
        } elseif ($id_deposito === 0){
            $total[0] = TestataScontrino::whereBetween('data', [(new self)->DataIni($data->format('Y-m-d H:i:s')),(new self)->DataFin($data->format('Y-m-d H:i:s'))])->where('id_cassa',$id_cassa)->sum('importo');                                                            
        } else {
            $total[0] = TestataScontrino::whereBetween('data', [(new self)->DataIni($data->format('Y-m-d H:i:s')),(new self)->DataFin($data->format('Y-m-d H:i:s'))])->where('id_deposito',$id_deposito)->sum('importo');                                                            
        }   
        $data1 = $data->modify('-1 days')->format('Y-m-d H:i:s');
        if (($id_deposito === 0) && ($id_cassa === 0)){
            $total[1] = TestataScontrino::whereBetween('data', [(new self)->DataIni($data1),(new self)->DataFin($data1)])->sum('importo');      
        } elseif ($id_deposito === 0){
            $total[1] = TestataScontrino::whereBetween('data', [(new self)->DataIni($data1),(new self)->DataFin($data1)])->where('id_cassa',$id_cassa)->sum('importo');      
        } else {
            $total[1] = TestataScontrino::whereBetween('data', [(new self)->DataIni($data1),(new self)->DataFin($data1)])->where('id_deposito',$id_deposito)->sum('importo');      
        }        
        $total[2] = ($total[1] > 0 ) ? intval( (($total[0] - $total[1]) / $total[1]) * 100 ) : '100 ';                                                   
        return $total;                                                              
    }

    public static function TotaleSettimana($data,$id_deposito,$id_cassa): array
    {    
        $data1 = new DateTime($data->format('Y-m-d H:i:s'));                     
        $daysofweek = date('w',strtotime($data->format('Y-m-d')));                 
        if (($id_deposito === 0) && ($id_cassa === 0)){
            $total[0] = TestataScontrino::whereBetween('data', [(new self)->DataIni($data->modify('-'.($daysofweek-1).' days')->format('Y-m-d H:i:s')),(new self)->DataFin($data->modify('+6 days')->format('Y-m-d H:i:s'))])->sum('importo');                 
        } elseif ($id_deposito === 0){
            $total[0] = TestataScontrino::whereBetween('data', [(new self)->DataIni($data->modify('-'.($daysofweek-1).' days')->format('Y-m-d H:i:s')),(new self)->DataFin($data->modify('+6 days')->format('Y-m-d H:i:s'))])->where('id_cassa',$id_cassa)->sum('importo');
        } else {
            $total[0] = TestataScontrino::whereBetween('data', [(new self)->DataIni($data->modify('-'.($daysofweek-1).' days')->format('Y-m-d H:i:s')),(new self)->DataFin($data->modify('+6 days')->format('Y-m-d H:i:s'))])->where('id_deposito',$id_deposito)->sum('importo');
        }   
        $data1->modify('-7 days');        
        $daysofweek = date('w',strtotime($data1->format('Y-m-d'))); 
        if (($id_deposito === 0) && ($id_cassa === 0)){
            $total[1] = TestataScontrino::whereBetween('data', [(new self)->DataIni($data1->modify('-'.($daysofweek-1).' days')->format('Y-m-d H:i:s')),(new self)->DataFin($data1->modify('+6 days')->format('Y-m-d H:i:s'))])->sum('importo'); 
        } elseif ($id_deposito === 0){
            $total[1] = TestataScontrino::whereBetween('data', [(new self)->DataIni($data1->modify('-'.($daysofweek-1).' days')->format('Y-m-d H:i:s')),(new self)->DataFin($data1->modify('+6 days')->format('Y-m-d H:i:s'))])->where('id_cassa',$id_cassa)->sum('importo'); 
        } else {
            $total[1] = TestataScontrino::whereBetween('data', [(new self)->DataIni($data1->modify('-'.($daysofweek-1).' days')->format('Y-m-d H:i:s')),(new self)->DataFin($data1->modify('+6 days')->format('Y-m-d H:i:s'))])->where('id_deposito',$id_deposito)->sum('importo'); 
        }   
        $total[2] = ($total[1] > 0 ) ? intval( (($total[0] - $total[1]) / $total[1]) * 100 ) : '100' ;                             
        return $total;                                                                    
    }

    public static function TotaleMese($data,$id_deposito,$id_cassa): array
    {        
        $m = $data->format('m');
        $y = $data->format('Y');
        $dataini = substr($data->format('Y-m-d H-i-s'),0,8).'01 00:00:00';
        $newdata = new DateTime($dataini);
        $gg = cal_days_in_month(CAL_GREGORIAN,$m,$y);        
        $datafin = substr($newdata->modify('+'.($gg-1).' days')->format('Y-m-d H-i-s'),0,10).' 23:59:59';        
        if (($id_deposito === 0) && ($id_cassa === 0)){
            $total[0] = TestataScontrino::whereBetween('data',[$dataini,$datafin])->sum('importo');                                    
        } elseif ($id_deposito === 0){    
            $total[0] = TestataScontrino::whereBetween('data',[$dataini,$datafin])->where('id_cassa',$id_cassa)->sum('importo');                                    
        } else {
            $total[0] = TestataScontrino::whereBetween('data',[$dataini,$datafin])->where('id_deposito',$id_deposito)->sum('importo');
        }    
        $data->modify('-1 months');
        $m = $data->format('m');
        $y = $data->format('Y');
        $dataini = substr($data->format('Y-m-d H-i-s'),0,8).'01 00:00:00';
        $newdata = new DateTime($dataini);
        $gg = cal_days_in_month(CAL_GREGORIAN,$m,$y);        
        $datafin = substr($newdata->modify('+'.($gg-1).' days')->format('Y-m-d H-i-s'),0,10).' 23:59:59';        
        if (($id_deposito === 0) && ($id_cassa === 0)){
            $total[1] = TestataScontrino::whereBetween('data',[$dataini,$datafin])->sum('importo');
        } elseif ($id_deposito === 0){
            $total[1] = TestataScontrino::whereBetween('data',[$dataini,$datafin])->where('id_cassa',$id_cassa)->sum('importo');
        } else {
            $total[1] = TestataScontrino::whereBetween('data',[$dataini,$datafin])->where('id_deposito',$id_deposito)->sum('importo');
        }     
        $total[2] = ($total[1] > 0 ) ? intval( (($total[0] - $total[1]) / $total[1]) * 100 ) : '100';
        return $total;                             
    }

    static function TotaleCasse($data,$id_deposito)
    {   
        if ($id_deposito === 0){     
            return TestataScontrino::whereBetween('testata_scontrino.data',[(new self)->DataIni($data->format('Y-m-d H-i-s')),(new self)->DataFin($data->format('Y-m-d H-i-s'))])                                    
                                    ->join('casse','testata_scontrino.id_cassa','=','casse.id')
                                    ->join('deposito','testata_scontrino.id_deposito','=','deposito.id')
                                    ->selectRaw('sum(testata_scontrino.importo) as prezzo, casse.descrizione as cassa , deposito.descrizione as deposito, testata_scontrino.id_deposito, testata_scontrino.id_cassa')
                                    ->groupBy('casse.descrizione','testata_scontrino.id_deposito','testata_scontrino.id_cassa')
                                    ->orderBy('deposito.descrizione')
                                    ->get();                                                                                                   
        } else {
            return TestataScontrino::whereBetween('testata_scontrino.data',[(new self)->DataIni($data->format('Y-m-d H-i-s')),(new self)->DataFin($data->format('Y-m-d H-i-s'))])                                    
                                    ->where('testata_scontrino.id_cassa',$id_deposito)
                                    ->join('casse','testata_scontrino.id_cassa','=','casse.id')
                                    ->join('deposito','testata_scontrino.id_deposito','=','deposito.id')
                                    ->selectRaw('sum(testata_scontrino.importo) as prezzo, casse.descrizione as cassa , deposito.descrizione as deposito, testata_scontrino.id_deposito, testata_scontrino.id_cassa')
                                    ->groupBy('casse.descrizione','testata_scontrino.id_deposito','testata_scontrino.id_cassa')
                                    ->orderBy('deposito.descrizione')
                                    ->get();                                                                                                   
        }                                  
    }

    static function Last10Days($data,$shoptill)
    {
        if ($shoptill != '0'){
            $id = substr($shoptill,5,strlen($shoptill)-5);
            switch (substr($shoptill,0,4)) {
                case 'shop':
                    return (new self)->QueryShop($data,$id);
                    break;
                
                case 'till':
                    return (new self)->QueryTill($data,$id);
                    break;                
            }
        } else {
            return (new self)->QueryNoShopTill($data);
        }                
    }

    private function DataIni($data):string
    {           
        return substr($data,0,10).' 00:00:00';
    }

    private function DataFin($data):string
    {        
        return substr($data,0,10).' 23:59:00';
    }

    private function QueryNoShopTill($data){
        return TestataScontrino::whereRaw("( date(testata_scontrino.data) between '".$data->modify('- 9 days')->format('Y-m-d')."' and '".$data->modify('+ 10 days')->format('Y-m-d')."')")                                
                                ->selectRaw('sum(testata_scontrino.importo) as prezzo, date(testata_scontrino.data) as newdata')
                                ->groupByRaw('date(testata_scontrino.data)')
                                ->orderByRaw('date(testata_scontrino.data)')
                                ->limit(10)
                                ->get();
    }

    private function QueryShop($data,$id_deposito){
        return TestataScontrino::whereRaw(" ( date(testata_scontrino.data) between '".$data->modify('- 9 days')->format('Y-m-d')."' and '".$data->modify('+ 10 days')->format('Y-m-d')."') and testata_scontrino.id_deposito = ".$id_deposito)                                
                                ->selectRaw('sum(testata_scontrino.importo) as prezzo, date(testata_scontrino.data) as newdata')
                                ->groupByRaw('date(testata_scontrino.data)')
                                ->orderByRaw('date(testata_scontrino.data)')
                                ->limit(10)
                                ->get();
    }

    private function QueryTill($data,$id_cassa){
        return TestataScontrino::whereRaw(" ( date(testata_scontrino.data) between '".$data->modify('- 9 days')->format('Y-m-d')."' and '".$data->modify('+ 10 days')->format('Y-m-d')."') and testata_scontrino.id_cassa = ".$id_cassa)                                
                                ->selectRaw('sum(testata_scontrino.importo) as prezzo, date(testata_scontrino.data) as newdata')
                                ->groupByRaw('date(testata_scontrino.data)')
                                ->orderByRaw('date(testata_scontrino.data)')
                                ->limit(10)
                                ->get();
    }

    static function ListaTransazioni($idcassa,$iddeposito,$data)
    {
        return TestataScontrino::where('id_deposito',$iddeposito)
                                ->where('id_cassa',$idcassa)
                                ->whereRaw(" DATE(data) = '".$data."'")
                                ->get();
    }

    static function AnnulloScontrino($id,$idoper)
    {
        $result = [];
        $result['status'] = '200';
        try 
        {
            TestataScontrino::where('id',$id)->update([
                'scontrino_annullato' => 1,
                'data_annullo' => now(),
                'operatore_annullo' => $idoper,
                'rileva_venduto' => 0
            ]);            
            $result['result'] = 'true';            
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['result'] = 'false';
            MyLog::WriteLog($th->getMessage(),'0');        
        }
        return $result;
    }
}
