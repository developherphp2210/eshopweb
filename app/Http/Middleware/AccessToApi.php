<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccessToApi
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
            $user = User::where('email',$request->email)->first();        
            $request->merge(['user_id' => $user->id]);   
        }

        return $next($request);
    }
}
