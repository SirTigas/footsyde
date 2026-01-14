<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //checking if the user has special acess to the route
        
        // if (Auth::check() && Auth::user()->role != 'admin')
        //     return redirect()->route('login')->with('erro', 'Essa rota necessita de acesso especial!');
        // return $next($request);

        if (Auth::check() && (Auth::user()->role === 'admin') && (Auth::user()->email_verified_at != NULL))
            return $next($request);
        return redirect()->route('login')->with('erro', 'Essa rota necessita de acesso especial!');
    }
}
