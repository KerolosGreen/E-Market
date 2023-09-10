<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){//Check If The UserLogged In
                if(Auth::user()->role==1){//Checl If The User Is An  Admin
                    return $next($request);//Allow Acces If Admin
                }
                else{
                return redirect('/');//redirect to home if not admin
                }
        }else{
            return redirect('/login');//redirect to login page
        }
        
    }
}
