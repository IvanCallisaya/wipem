<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Core\Utils\CoreResponse;

class RedireccionSiEsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->type == 1)
            return $next($request);
        if($request->isJson())
            return CoreResponse::formatResponse(['code'=>CoreResponse::$CODE_WARNING, 'error'=>'Usted no tiene el permiso para acceder a este recurso.']);
        return abort('403');
    }
}