<?php

namespace App\Http\Middleware;

use Closure;
use function dd;

class AddHeader
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
        if ($request->has('access_token')) {
            $request->headers->set('Authorization', 'Bearer ' . $request->get('access_token'));
        }

        return $next($request);
    }
}
