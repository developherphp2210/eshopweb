<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparti extends Model
{
    use HasFactory;

    protected $table = 'reparti';

    protected $fillable=[
        'id',        
        'codice',
        'descrizione',
        'posizione'
    ];

    static function GetList()
    {
        return Reparti::orderBy('codice')->get();
    }
}
