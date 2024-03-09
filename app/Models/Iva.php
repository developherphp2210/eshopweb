<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iva extends Model
{
    use HasFactory;

    protected $table = 'iva';

    protected $fillable = [
        'id',
        'codice',
        'descrizione',
        'aliquota',
        'reparto_fiscale',
        'attivo'
    ];
    
    static function GetList()
    {
        return Iva::orderBy('codice')->get();
    }

    static function SingleIva(string $id)
    {
        return Iva::where('id',$id)->first();
    }
}
