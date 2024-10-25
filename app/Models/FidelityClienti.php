<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FidelityClienti extends Model
{
    use HasFactory;

    protected $table = 'fidelity_clienti';

    protected $fillable=[
        'id',
        'id_cliente',
        'id_fidelity'
    ];

    public $timestamps = false;
}
