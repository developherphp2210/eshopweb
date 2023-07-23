<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function main(){  
        return view('admin.mainpage_admin')->with(['title' => 'Main Page','user' => session('user')]);        
    }

    public function insert(){        
        return view('admin.insert_user')->with(['title' => 'Inserimento Nuovo Utente','user' => session('user')]);
    }

    public function list(){
        $user_list = User::GetMyList();
        return view('admin.users_list')->with(['title' => 'Lista Utenti','user' => session('user'),'userslist' => $user_list]);
    }

    public function show($id){
        $myuser = User::GetMyUser($id);
        return view('admin.user')->with(['title' => 'Scheda Utente','user' => session('user'),'myuser' => $myuser]);
    }
}
