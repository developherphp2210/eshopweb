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
        'descrizione'
    ];
    

    static function GetList()
    {
        return Depositi::orderBy('codice')->get();
    }

    static function Show($id)
    {
        return Depositi::where('id',$id)->first();
    }
    
}
