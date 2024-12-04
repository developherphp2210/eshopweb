<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Node\Stmt\TryCatch;
use App\MyClass\MyLog;

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
        'user_name',
        'password',
        'email',
        'id_operatore',
        'id_cliente',
        'piva',        
        'type',
        'nome',
        'cognome',
        'indirizzo',
        'citta',
        'telefono',
        'codice_fiscale',
        'cap',
        'prov',
        'image',
        'primo_accesso'
    ];

    static function GetMyList(){
        return User::where('type','0')->get();
    }

    static function GetMyUser($id){
        return User::where('id',$id)->first();
    }

    static function AccessUser($data)
    {
        if (isset($data->email)){
            $user = User::where('email',$data->email)->first();
        } else {
            $user = User::where('user_name',$data->user_name)->first();
        }
        if ($user->type == '0')
        {
            return User::where('users.id',$user->id)
                ->join('operatori','operatori.id','=','users.id_operatore')
                ->join('profili','profili.id','=','operatori.id_profilo')
                ->first();
        } else {
            return $user;
        }

    }

    static function RecoveryPassword($mail){
        $user = User::where('user_name',$mail)->first();
        if ($user){
            $password = (new self)->create_password();            
            $user->password = Hash::make($password);
            $user->save();
            // inserire invio mail
            $notification['message'] = 'Ti è stata inviata una password temporanea al tuo indirizzo Email';
            $notification['status'] = 'false';
        } else {
            $notification['message'] = 'Il tuo indirizzo Email non risulta nel nostro elenco!!';
            $notification['status'] = 'true';
            MyLog::WriteLog('INDIRIZZO EMAIL NON TROVATO',0);
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
            $user->nome = $request->nome;
            $user->cognome = $request->cognome;
            $user->indirizzo = $request->indirizzo;
            $user->citta = $request->citta;
            $user->cap = $request->cap;
            $user->codice_fiscale = $request->codice_fiscale;
            // $user->email = $request->email;
            $user->telefono = $request->telefono;
            $user->prov = $request->prov;
            $user->piva = $request->piva;        
            $user->save();
            $notification['message'] = 'Modifiche effettuate';
            $notification['error'] = 'false';
        } catch (\Throwable $th) {
            $notification['message'] = $th->getMessage();
            $notification['error'] = 'true';            
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $notification;        
    }

    static function changePassword($request,$user) {
        if (Hash::check($request->oldpassword,$user->password)){
            $user->password = Hash::make($request->newpassword);
            $user->save();
            $notification['message'] = 'Password Aggiornata!!';
            $notification['status'] = 'false';            
        } else {
            $notification['message'] = 'Password Corrente Errata!!';
            $notification['status'] = 'true'; 
            MyLog::WriteLog('PASSWORD CORRENTE ERRATA',0);           
        }
        return $notification;
    }

    static function CreateUser($request){
        $password = (new self)->create_password();
        return User::create([
            // 'email' => $request->email,
            'password' => Hash::make($password),
            'user_name' => ($request->user_name != '') ? $request->user_name :$request->email,
            'piva' => $request->piva,
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'indirizzo' => $request->indirizzo,
            'citta' => $request->citta,
            'telefono' => $request->telefono,
            'codice_fiscale' =>$request->codice_fiscale,
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
