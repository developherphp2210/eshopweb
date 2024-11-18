<?php

namespace App\Http\Controllers;

use App\Models\TipiOfferte;
use Illuminate\Http\Request;

class OfferteController extends Controller
{
    static function tipiOfferte($idcasse)
    {
        $result = [];
        try {
            $result['status'] = '200';
            $result['result'] = 'true';            
            $result['items'] = TipiOfferte::GetListCasse($idcasse);
        } catch (\Throwable $th) {
            $result['status'] = '400';
            $result['result'] = 'false';
            $result['error'] = $th->getMessage();
        }                
        return $result;        
    }
}
