<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotLoggedIn
{
    public function handle($request, Closure $next)
    {
   
        if (!session()->has('user_id')) {
         
            $response = response('Unauthorized access. Redirecting...', 401);

      
            $response->header('Refresh', '5;url=' . route('home'));

            return $response;
        }

        return $next($request);
    }
}
