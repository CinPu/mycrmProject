<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class admin_access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       if(Auth::check()){
           if(Auth::user()->hasAnyRole("Admin")){
               return $next($request);
           }else{
               return redirect()->back();
           }
       }else{
           return redirect("login");
       }

    }
}
