<?php
namespace App\MyClass;

use Illuminate\Support\Facades\Storage;
use DateTime;

class Utility
{

    static function DeleteIMG($path)
    {
        if(Storage::exists($path)){
            Storage::delete($path);            
        }
    }

    static function DataIni($data):string
    {           
        return substr($data,0,10).' 00:00:00';
    }

    static function DataFin($data):string
    {        
        return substr($data,0,10).' 23:59:00';
    }

    static function AggiornaData($request)
    {
        if (isset($request->newdate)){
            return new DateTime($request->newdate);            
        } else {
            return new DateTime('now'); 
        }   
    }

    static function create_password($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}