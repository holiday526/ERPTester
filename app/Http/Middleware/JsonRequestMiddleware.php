<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class JsonRequestMiddleware
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
        if ( in_array($request->method(), array('POST', 'PUT', 'PATCH')) && !($request->isJson()) ) {
//            $data = $request->json()->all();
//            $request->request->replace(is_array($data) ? $data : null);
            abort(
                Config::get('constants.status.forbidden')
            );
        }
        return $next($request);
    }

}
