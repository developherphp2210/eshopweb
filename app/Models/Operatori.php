<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operatori extends Model
{
    use HasFactory;

    protected $table = 'operatori';

    protected $fillable = [
        'id',
        'codice',
        'descrizione',
        'password',
        'barcode',
        'attivo'
    ];

    static function GetList()
    {
        return Operatori::OrderBy('codice')->get();
    }
}
