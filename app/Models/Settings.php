<?php

namespace App\Models;

use App\Models\Settings as ModelsSettings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable=[
         'id',
         'user_id',
         'riga1',
         'riga2',
         'riga3',
         'riga4',
         'riga5',
         'riga6',
         'testata',
         'corpo'
    ];

    public $timestamps = false;

    static function CreateSettings($userid){
        Settings::create([
            'user_id' => $userid
        ]);
    }

    static function GetMySetting($userid){        
        return Settings::where('user_id',$userid)->first();
    }
}
