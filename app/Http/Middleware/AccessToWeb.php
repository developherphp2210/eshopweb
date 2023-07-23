<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccessToWeb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $valid = $request->validate([
            'email' => 'required | email',
            'password' => 'required | string'
        ]);            

        if (Auth::attempt($valid,true))
        {
            $request->session()->regenerate();                       
            $user = User::where('email',$request->email)->first();                                            
            $request->session()->put('user',$user);
            return $next($request);            
        }

        return redirect()->back()->withErrors(['errors' => 'Utente non Registrato']);        
    }
}
