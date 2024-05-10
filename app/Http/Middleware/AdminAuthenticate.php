<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() ) {
            // return $next($request);
            return redirect()-> route('account.dashboard');
        }
        
        // if(Auth::check()){
        //     if(Auth::user()->role == 'customer'){
        //         return $next($request);
        //     }
        //     else{
        //         return route('account.login');
        //     }
        // }
        else{
            return $next($request);
       
        }
    }
}