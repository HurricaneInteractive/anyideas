<?php

namespace App\Http\Middleware;

use Closure;

class SecureApi
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
        $approved = array(
            '127.0.0.1:8000',
            'anyideas.herokuapp.com'
        );

        $host = $request->header('host');

        if (!in_array($host, $approved)) {
            return abort(401);
        }

        return $next($request);
    }
}
