<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Event;
use App\Events\AdminAuth;
class CheckAdminAuth
{
    //use RbacCheck;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status=Event::fire(new AdminAuth($request));
        $status=array_pop($status);        
        if ($status['code']!=200){        
           return viewError($status['error'],$status['url']);
        }
        return $next($request);
    }
}
