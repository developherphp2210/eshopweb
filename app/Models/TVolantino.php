<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TVolantino extends Model
{
    use HasFactory;

    protected $table = 'testata_volantino';

    protected $fillable = [
        'id',        
        'descrizione',
        'data_inizio',
        'data_fine',
        'no_ticket',
        'no_offtra'
    ];
}
