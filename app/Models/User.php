<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Node\Stmt\TryCatch;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * 
     * @var string
     * 
     */
    
    protected $table = 'users';

    /**
     * @var array
     */

    protected $fillable=[
        'email',
        'password',
        'piva',
        'user_name',
        'type',
        'firstname',
        'lastname',
        'address',
        'city',
        'phone',
        'business_name',
        'cap',
        'codfisc',
        'image'
    ];

    static function GetMyList(){
        return User::where('type','0')->get();
    }

    static function GetMyUser($id){
        return User::where('id',$id)->first();
    }

    static function RecoveryPassword($mail){
        $user = User::where('email',$mail)->first();
        if ($user){
            $password = (new self)->create_password();            
            $user->password = Hash::make($password);
            $user->save();
            // inserire invio mail
            $notification['message'] = 'Ti è stata inviata una password temporanea al tuo indirizzo Email';
            $notification['status'] = true;
        } else {
            $notification['message'] = 'Il tuo indirizzo Email non risulta nel nostro elenco!!';
            $notification['status'] = false;
        }
        return $notification;
    }

    static function CreateFidelity($request){
        return User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_name' => $request->user_name,
            'type' => '1'
        ]);
    }

    static function modify_user($request,$user){
        try {
            if( $request->hasFile('photo') ) {
                $path = $request->file('photo')->storeAs('image','user'.$user->id.'.'.$request->photo->extension());
                $user->image = $path;  
            }                     
            $user->user_name = $request->user_name;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->cap = $request->cap;
            $user->codfisc = $request->codfisc;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->business_name = $request->business_name;
            $user->piva = $request->piva;        
            $user->save();
            $notification['message'] = 'Modifiche effettuate';
            $notification['status'] = true;
        } catch (\Throwable $th) {
            $notification['message'] = $th->getMessage();
            $notification['status'] = false;            
        }
        return $notification;        
    }

    static function changePassword($request,$user) {
        if (Hash::check($request->oldpassword,$user->password)){
            $user->password = Hash::make($request->newpassword);
            $user->save();
            $notification['message'] = 'Password Aggiornata!!';
            $notification['status'] = true;            
        } else {
            $notification['message'] = 'Password Corrente Errata!!';
            $notification['status'] = false;            
        }
        return $notification;
    }

    static function CreateUser($request){
        $password = (new self)->create_password();
        return User::create([
            'email' => $request->email,
            'password' => Hash::make($password),
            'user_name' => ($request->user_name != '') ? $request->user_name :$request->email,
            'piva' => $request->piva,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'business_name' =>$request->business_name,
            'cap' => $request->cap            
        ]);
        // inserire invio mail
    }

    private function create_password($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
}
