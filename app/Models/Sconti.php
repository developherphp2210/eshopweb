<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sconti extends Model
{
    use HasFactory;

    protected $table = 'operatori';

    protected $fillable = [
        'id',
        'codice',
        'descrizione',
        'tipo',
        'valore',
        'attivo'
    ];

    static function GetList()
    {
        return Sconti::OrderBy('codice')->get();
    }
}
