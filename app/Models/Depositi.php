<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depositi extends Model
{
    use HasFactory;

    protected $table = 'deposito';

    protected $fillable = [
        'id',        
        'codice',
        'descrizione',
        'id_listino'
    ];
    

    static function GetList()
    {
        return Depositi::orderBy('codice')->get();
    }

    static function GetName($id_deposito){
        return Depositi::where('id',$id_deposito)
                    ->select('descrizione')
                    ->first();
    }

    static function Show($id)
    {
        return Depositi::where('id',$id)->first();
    }

    static function GetId($codice)
    {
        return Depositi::where('codice',$codice)->select('id')->first();
    }
    
}
