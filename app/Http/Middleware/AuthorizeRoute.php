<?php

namespace App\Http\Middleware;

use Closure;
use App\Lib\Lib;
use Illuminate\Support\Facades\Auth;

class AuthorizeRoute
{
    
    public function handle($request, Closure $next, $guard = null)
    {
        $authorized     = true;  
        $user = Auth::user();
        
        $routename = $request->route()->getName();
        if ($user->hasRole('superadmin')){
            $authorized = true;
        }else if(!strpos($routename,'ermission')){
            $authorized = true;
        }else if($user->canDo($routename)){
            $authorized = true;
        }
                
        if($authorized){
            return $next($request);
        }else{
            return Lib::sendError("Not Authorizad",401);
        }
        
    }
    
}
