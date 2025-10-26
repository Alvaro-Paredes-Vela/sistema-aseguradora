<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateCliente
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? ['cliente'] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $next($request);
            }
        }

        return redirect('/login-cliente')->with('error', 'Debes iniciar sesión como cliente.');
    }
}
