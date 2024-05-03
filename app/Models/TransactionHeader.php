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

	

	

    

    

    static function GetMyTransaction($id){
        return TransactionHeader::where('id',$id)->first();
    }
}
