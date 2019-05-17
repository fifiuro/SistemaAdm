<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TipoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $ruta)
    {
        dd($ruta);

        

        if('1' != Auth::user()->tipo){
            abort(403, "No tienes permisos, consulta con el administrador del sistema.");
        }

        return $next($request);
    }
}


