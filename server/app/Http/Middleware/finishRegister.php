<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class finishRegister
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
        $currentUrl = URL::current();
        if(!Auth::check()){
            return $next($request);
        }
        if(stristr($currentUrl, "user/setting") || stristr($currentUrl, "logout") ){
            return $next($request);
        } else if(Auth::user()->type <= 0){
            return redirect("/user/setting/setting");
        }
        return $next($request);
    }
}
