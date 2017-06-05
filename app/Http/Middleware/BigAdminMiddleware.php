<?php

namespace App\Http\Middleware;

use Closure;

class BigAdminMiddleware
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
      if(!$request->user()->isBigAdmin()){
        abort(404);
      }
        return $next($request);
    }
}
