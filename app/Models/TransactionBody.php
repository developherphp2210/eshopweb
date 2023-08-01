<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Codean;
use App\Models\Department;
use App\Models\Article;
use App\Models\Vat;

class TransactionBody extends Model
{
    use HasFactory;

    protected $table = 'transaction_body';

	public $timestamps = false;

    protected $fillable = [
        'id',
	    'transaction_id',
	    'articles_id',
	    'departments_id',
	    'vat_id',
	    'codean_id',
	    'price',
	    'discounts',
	    'quantity',
	    'type',
        'discounts_coupon' 
    ];

	static function InsertTransactionBody($request){
		$department_id = Department::GetDepartmentId($request);
		$vat_id = Vat::GetVatId($request);
    	$article_id = Article::GetArticleId($request,$department_id,$vat_id);		
        TransactionBody::create([
            'transaction_id' => $request->trans_id,
            'articles_id' => $article_id,
            'departments_id' => $department_id,
            'vat_id' => $vat_id,
            'codean_id' => (($request->codean <> null) or ($request->codean <> '')) ? Codean::GetCodeanId($request,$article_id) : '0',
            'price' => str_replace(',','.',$request->importo),
            'discounts' => str_replace(',','.',$request->sconti),
            'discounts_coupon' => str_replace(',','.',$request->sconti_coupon),
            'quantity' => str_replace(',','.',$request->qt),
            'type' => $request->tiporiga
        ]);
        return $request->trans_id;
	}

    static function Top10Departments($data,$userid,$shoptill){
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
        return TransactionBody::whereRaw("transaction_header.user_id = ".$userid." and  date(transaction_header.data) = '".$data->format('Y-m-d')."'")
                              ->join('transaction_header','transaction_header.id','=','transaction_body.transaction_id')
                              ->join('departments','departments.id','=','transaction_body.departments_id') 
                              ->selectRaw(' sum( ( transaction_body.price * transaction_body.quantity) - transaction_body.discounts_coupon) as totale, departments.description ')
                              ->groupBy('departments.description')
                              ->orderByRaw('totale desc')
                              ->limit(10)
                              ->get();
    }

    private function QueryShop($userid,$data,$shopid){
        return TransactionBody::whereRaw("transaction_header.user_id = ".$userid." and date(transaction_header.data) = '".$data->format('Y-m-d')."' and transaction_header.shop_id = ".$shopid)
                              ->join('transaction_header','transaction_header.id','=','transaction_body.transaction_id')
                              ->join('departments','departments.id','=','transaction_body.departments_id') 
                              ->selectRaw(' sum( ( transaction_body.price * transaction_body.quantity) - transaction_body.discounts_coupon) as totale, departments.description ')
                              ->groupBy('departments.description')
                              ->orderByRaw('totale desc')
                              ->limit(10)
                              ->get();
    }

    private function QueryTill($userid,$data,$tillid){
        return TransactionBody::whereRaw("transaction_header.user_id = ".$userid." and date(transaction_header.data) = '".$data->format('Y-m-d')."' and transaction_header.till_id = ".$tillid)
                              ->join('transaction_header','transaction_header.id','=','transaction_body.transaction_id')
                              ->join('departments','departments.id','=','transaction_body.departments_id') 
                              ->selectRaw(' sum( ( transaction_body.price * transaction_body.quantity) - transaction_body.discounts_coupon) as totale, departments.description ')
                              ->groupBy('departments.description')
                              ->orderByRaw('totale desc')
                              ->limit(10)
                              ->get();
    }

    static function SingleReceipt($id){
        return TransactionBody::where('transaction_header.id',$id)
                               ->join('transaction_header','transaction_header.id','=','transaction_body.transaction_id')  
                               ->join('articles','articles.id','=','transaction_body.articles_id')
                               ->selectRaw('transaction_body.price,transaction_body.quantity,transaction_body.type,articles.description AS articolo,(transaction_body.price * transaction_body.quantity) AS totale,transaction_body.discounts')
                               ->get();
    }

}
