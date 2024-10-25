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

    static function ConverTimestamp($data){        
        return substr($data,6,4).'-'.substr($data,3,2).'-'.substr($data,0,2).' '.substr($data,11,8);
    }

    static function ean13_check_digit($digits)
    {
        /* 
            Prende i primi 12 caratteri dell'ean dopo averlo giustificato con "0" alla lunghezza
            di 13 caratteri
        */
        $digits =substr(str_pad((string)$digits,13,"0",STR_PAD_RIGHT),0,12);
        /* 
            somma i digit di posizione pari moltiplicati per 3 con quelli di posizione dispari
        */
        $tot=0;
        for ($i =0; $i<=11; $i++) {
        //    $digit=(int)substr($digits,i,1);
            if ((int)fmod($i+1,2)===0) {
                    $tot+=3*$digits[$i];
                            }
            else {
                  $tot+=$digits[$i];
                }
        }
        /* Si calcola il più piccolo numero intero che sommato a tot dia un multiplo di 10 */
        $next_ten=(ceil($tot/10))*10;
        /* il check digit è allora la differenza tra il  next_ten e tot */
        $check_digit = $next_ten - $tot;
        return $digits . $check_digit;
    }
}