<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isactive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            if(Auth::user()->active==1){//Checl If The User Is Activated
                return $next($request);//Allow Acces If Active
            }else{
                session()->flush();
        
                Auth::logout();
        
                return redirect('login');//redirect to login page
            }
    }
}
