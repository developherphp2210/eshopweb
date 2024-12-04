<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable=[
         'id',
         'id_deposito',
         'riga1',
         'riga2',
         'riga3',
         'riga4',
         'riga5',
         'riga6',
         'testata',
         'corpo',
         'filepdf'
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

    static function SaveSettingsUsers($request,$userid){
        try {
            $setting = Settings::where('user_id',$userid)->first();
            $setting->testata = $request->testata;
            $setting->corpo = $request->corpo;
            $setting->save();
            $notification['message'] = 'Impostazioni Aggiornate';
            $notification['status'] = true;
        } catch (\Throwable $th) {
            $notification['message'] = $th->getMessage();
            $notification['status'] = false;
        }
        return $notification;
    }

    static function GetMyFilePdf($userid){
        return Settings::where('user_id',$userid)->select('filepdf')->first();
    }

    static function SaveMyFilePdf($userid,$path){
        $setting = Settings::where('user_id',$userid)->first();
        $setting->filepdf = $path;
        $setting->save();
    }

    static function DeleteMyFilePdf($userid){
        $setting = Settings::where('user_id',$userid)->first();
        $setting->filepdf = '';
        $setting->save();
    }
}
