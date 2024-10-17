<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Depositi;
use App\Models\Casse;
use App\MyClass\Utility;

class MovimentiVerpre extends Model
{
    use HasFactory;

    protected $table = 'movimenti_verpre';
        
    protected $fillable = [
        'id',
        'id_deposito',
        'id_cassa',
        'id_operatore',
        'id_causale',
        'importo',
        'data'
    ];  
    
    static function InsertMovimentiVerpre($data)
    {
        MovimentiVerpre::create([
            'id_deposito' => Depositi::GetId($data[5])['id'],
            'id_cassa' => Casse::GetId($data[6])['id'],
            'id_operatore' => $data[3],
            'data' => Utility::ConverTimestamp($data[2]),
            'id_causale' => Causali::GetId($data[1])['id'],
            'importo' => str_replace(',','.',$data[7])
        ]);
    }
}
