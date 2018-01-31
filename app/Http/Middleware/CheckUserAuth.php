<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Event;
use App\Events\UserAuth;
class CheckUserAuth
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
        Event::fire(new UserAuth());
        return $next($request);
    }
}
