<?php

namespace App\Http\Controllers;

use App\Models\Depositi;
use App\Models\TListino;
use Illuminate\Http\Request;

class DepositoController extends Controller
{
    public function Index()
    {
        $listadepositi['deposito'] = Depositi::GetList();
        $listadepositi['listino'] = TListino::GetList();
        return view('users.barriera.lista_depositi')->with(['title' => 'Lista Depositi','index' => '21', 'listadepositi' => $listadepositi]);
    }

    public function Show(string $id)
    {
        return Depositi::Show($id);
    }
}
