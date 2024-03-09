<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\Till;
use App\Models\Cashier;
use App\Models\Customer;
use DateTime;
use Illuminate\Support\Facades\DB;

class TransactionHeader extends Model
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
        'punti_jolly'
    ];

	public static function InsertTransactionHeader($request) {
		$shop_id = Shop::GetShopId($request);
        $transHeader = TransactionHeader::create([            
            'id_deposito' => $id_deposito,
            'id_cassa' => Till::GetTillId($request,$id_cassa),
            'id_cliente' => $request->codcli == '0' ? '0' : Customer::GetCustomerId($request),
            'id_operatore' => Cashier::GetCashierId($request),
            'importo' => str_replace(',','.',$request->totale),
            // 'discount' => $request->sconti <> null ? str_replace(',','.',$request->sconti) : '0',
            'data' => (new self)->ConverTimestamp($request->datatransaction),
            'numero_scontrino' => $request->numtrans,
            'punti' => $request->punti,
            'punti_jolly' => $request->pjolly
        ]);
        return $transHeader->id;
	}

	private function ConverTimestamp($data){        
        return substr($data,6,4).'-'.substr($data,3,2).'-'.substr($data,0,2).' '.substr($data,11,8);
    }

    public static function TotalDay($userid,$data,$shopid,$tillid): array
    {                              
        if (($shopid === 0) && ($tillid === 0)){
            $total[0] = TransactionHeader::whereBetween('data', [(new self)->DataIni($data->format('Y-m-d H:i:s')),(new self)->DataFin($data->format('Y-m-d H:i:s'))])->sum('importo');                                                            
        } elseif ($shopid === 0){
            $total[0] = TransactionHeader::whereBetween('data', [(new self)->DataIni($data->format('Y-m-d H:i:s')),(new self)->DataFin($data->format('Y-m-d H:i:s'))])->where('id_cassa',$tillid)->sum('importo');                                                            
        } else {
            $total[0] = TransactionHeader::whereBetween('data', [(new self)->DataIni($data->format('Y-m-d H:i:s')),(new self)->DataFin($data->format('Y-m-d H:i:s'))])->where('id_deposito',$shopid)->sum('importo');                                                            
        }   
        $data1 = $data->modify('-1 days')->format('Y-m-d H:i:s');
        if (($shopid === 0) && ($tillid === 0)){
            $total[1] = TransactionHeader::whereBetween('data', [(new self)->DataIni($data1),(new self)->DataFin($data1)])->sum('importo');      
        } elseif ($shopid === 0){
            $total[1] = TransactionHeader::whereBetween('data', [(new self)->DataIni($data1),(new self)->DataFin($data1)])->where('id_cassa',$tillid)->sum('importo');      
        } else {
            $total[1] = TransactionHeader::whereBetween('data', [(new self)->DataIni($data1),(new self)->DataFin($data1)])->where('id_deposito',$shopid)->sum('importo');      
        }        
        $total[2] = ($total[1] > 0 ) ? intval( (($total[0] - $total[1]) / $total[1]) * 100 ) : '100 ';                                                   
        return $total;                                                              
    }

    public static function TotalWeek($userid,$data,$shopid,$tillid): array
    {    
        $data1 = new DateTime($data->format('Y-m-d H:i:s'));                     
        $daysofweek = date('w',strtotime($data->format('Y-m-d')));                 
        if (($shopid === 0) && ($tillid === 0)){
            $total[0] = TransactionHeader::whereBetween('data', [(new self)->DataIni($data->modify('-'.($daysofweek-1).' days')->format('Y-m-d H:i:s')),(new self)->DataFin($data->modify('+6 days')->format('Y-m-d H:i:s'))])->sum('importo');                 
        } elseif ($shopid === 0){
            $total[0] = TransactionHeader::whereBetween('data', [(new self)->DataIni($data->modify('-'.($daysofweek-1).' days')->format('Y-m-d H:i:s')),(new self)->DataFin($data->modify('+6 days')->format('Y-m-d H:i:s'))])->where('id_cassa',$tillid)->sum('importo');
        } else {
            $total[0] = TransactionHeader::whereBetween('data', [(new self)->DataIni($data->modify('-'.($daysofweek-1).' days')->format('Y-m-d H:i:s')),(new self)->DataFin($data->modify('+6 days')->format('Y-m-d H:i:s'))])->where('id_deposito',$shopid)->sum('importo');
        }   
        $data1->modify('-7 days');        
        $daysofweek = date('w',strtotime($data1->format('Y-m-d'))); 
        if (($shopid === 0) && ($tillid === 0)){
            $total[1] = TransactionHeader::whereBetween('data', [(new self)->DataIni($data1->modify('-'.($daysofweek-1).' days')->format('Y-m-d H:i:s')),(new self)->DataFin($data1->modify('+6 days')->format('Y-m-d H:i:s'))])->sum('importo'); 
        } elseif ($shopid === 0){
            $total[1] = TransactionHeader::whereBetween('data', [(new self)->DataIni($data1->modify('-'.($daysofweek-1).' days')->format('Y-m-d H:i:s')),(new self)->DataFin($data1->modify('+6 days')->format('Y-m-d H:i:s'))])->where('id_cassa',$tillid)->sum('importo'); 
        } else {
            $total[1] = TransactionHeader::whereBetween('data', [(new self)->DataIni($data1->modify('-'.($daysofweek-1).' days')->format('Y-m-d H:i:s')),(new self)->DataFin($data1->modify('+6 days')->format('Y-m-d H:i:s'))])->where('id_deposito',$shopid)->sum('importo'); 
        }   
        $total[2] = ($total[1] > 0 ) ? intval( (($total[0] - $total[1]) / $total[1]) * 100 ) : '100' ;                             
        return $total;                                                                    
    }

    public static function TotalMonth($userid,$data,$shopid,$tillid): array
    {        
        $m = $data->format('m');
        $y = $data->format('Y');
        $dataini = substr($data->format('Y-m-d H-i-s'),0,8).'01 00:00:00';
        $newdata = new DateTime($dataini);
        $gg = cal_days_in_month(CAL_GREGORIAN,$m,$y);        
        $datafin = substr($newdata->modify('+'.($gg-1).' days')->format('Y-m-d H-i-s'),0,10).' 23:59:59';        
        if (($shopid === 0) && ($tillid === 0)){
            $total[0] = TransactionHeader::whereBetween('data',[$dataini,$datafin])->sum('importo');                                    
        } elseif ($shopid === 0){    
            $total[0] = TransactionHeader::whereBetween('data',[$dataini,$datafin])->where('id_cassa',$tillid)->sum('importo');                                    
        } else {
            $total[0] = TransactionHeader::whereBetween('data',[$dataini,$datafin])->where('id_deposito',$shopid)->sum('importo');
        }    
        $data->modify('-1 months');
        $m = $data->format('m');
        $y = $data->format('Y');
        $dataini = substr($data->format('Y-m-d H-i-s'),0,8).'01 00:00:00';
        $newdata = new DateTime($dataini);
        $gg = cal_days_in_month(CAL_GREGORIAN,$m,$y);        
        $datafin = substr($newdata->modify('+'.($gg-1).' days')->format('Y-m-d H-i-s'),0,10).' 23:59:59';        
        if (($shopid === 0) && ($tillid === 0)){
            $total[1] = TransactionHeader::whereBetween('data',[$dataini,$datafin])->sum('importo');
        } elseif ($shopid === 0){
            $total[1] = TransactionHeader::whereBetween('data',[$dataini,$datafin])->where('id_cassa',$tillid)->sum('importo');
        } else {
            $total[1] = TransactionHeader::whereBetween('data',[$dataini,$datafin])->where('id_deposito',$shopid)->sum('importo');
        }     
        $total[2] = ($total[1] > 0 ) ? intval( (($total[0] - $total[1]) / $total[1]) * 100 ) : '100';
        return $total;                             
    }

    static function TotalTills($userid,$data,$shopid)
    {   
        if ($shopid === 0){     
            return TransactionHeader::whereBetween('testata_scontrino.data',[(new self)->DataIni($data->format('Y-m-d H-i-s')),(new self)->DataFin($data->format('Y-m-d H-i-s'))])                                    
                                    ->join('casse','testata_scontrino.id_cassa','=','casse.id')
                                    ->join('deposito','testata_scontrino.id_deposito','=','deposito.id')
                                    ->selectRaw('sum(testata_scontrino.importo) as prezzo, casse.descrizione as cassa , deposito.descrizione as deposito, testata_scontrino.id_deposito, testata_scontrino.id_cassa')
                                    ->groupBy('casse.descrizione','testata_scontrino.id_deposito','testata_scontrino.id_cassa')
                                    ->orderBy('deposito.descrizione')
                                    ->get();                                                                                                   
        } else {
            return TransactionHeader::whereBetween('testata_scontrino.data',[(new self)->DataIni($data->format('Y-m-d H-i-s')),(new self)->DataFin($data->format('Y-m-d H-i-s'))])
                                    ->where('testata_scontrino.user_id',$userid)
                                    ->where('testata_scontrino.shop_id',$shopid)
                                    ->join('casse','testata_scontrino.id_cassa','=','casse.id')
                                    ->join('shops','testata_scontrino.id_deposito','=','shops.id')
                                    ->selectRaw('sum(testata_scontrino.amount) as prezzo, casse.descrizione as cassa , shops.descrizione as deposito, testata_scontrino.id_deposito, testata_scontrino.id_cassa')
                                    ->groupBy('casse.descrizione','testata_scontrino.id_deposito','testata_scontrino.id_cassa')
                                    ->orderBy('shops.descrizione')
                                    ->get();                                                                                                   
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

    static function Last10Days($data,$userid,$shoptill)
    {
        if ($shoptill != '0'){
            $id = substr($shoptill,5,strlen($shoptill)-5);
            switch (substr($shoptill,0,4)) {
                case 'shop':
                    return (new self)->QueryShop($userid,$data,$id);
                    break;
                
                case 'till':
                    return (new self)->QueryTill($userid,$data,$id);
                    break;                
            }
        } else {
            return (new self)->QueryNoShopTill($userid,$data);
        }                
    }

    private function QueryNoShopTill($userid,$data){
        return TransactionHeader::whereRaw("( date(testata_scontrino.data) between '".$data->modify('- 9 days')->format('Y-m-d')."' and '".$data->modify('+ 10 days')->format('Y-m-d')."')")                                
                                ->selectRaw('sum(testata_scontrino.importo) as prezzo, date(testata_scontrino.data) as newdata')
                                ->groupByRaw('date(testata_scontrino.data)')
                                ->orderByRaw('date(testata_scontrino.data)')
                                ->limit(10)
                                ->get();
    }

    private function QueryShop($userid,$data,$shopid){
        return TransactionHeader::whereRaw("and ( date(testata_scontrino.data) between '".$data->modify('- 9 days')->format('Y-m-d')."' and '".$data->modify('+ 10 days')->format('Y-m-d')."') and transaction_header.shop_id = ".$shopid)                                
                                ->selectRaw('sum(testata_scontrino.importo) as prezzo, date(testata_scontrino.data) as newdata')
                                ->groupByRaw('date(testata_scontrino.data)')
                                ->orderByRaw('date(testata_scontrino.data)')
                                ->limit(10)
                                ->get();
    }

    private function QueryTill($userid,$data,$tillid){
        return TransactionHeader::whereRaw("and ( date(testata_scontrino.data) between '".$data->modify('- 9 days')->format('Y-m-d')."' and '".$data->modify('+ 10 days')->format('Y-m-d')."') and transaction_header.till_id = ".$tillid)                                
                                ->selectRaw('sum(testata_scontrino.importo) as prezzo, date(testata_scontrino.data) as newdata')
                                ->groupByRaw('date(testata_scontrino.data)')
                                ->orderByRaw('date(testata_scontrino.data)')
                                ->limit(10)
                                ->get();
    }

    static function GetMyTransaction($id){
        return TransactionHeader::where('id',$id)->first();
    }
}
