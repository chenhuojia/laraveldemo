<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        
    ];
    
    public function handle($request, Closure $next)
    {
        // Add this:
        if($request->method() == 'DELETE')
        {
            return $next($request);
        }else{
            if (
                $this->isReading($request) ||
                $this->runningUnitTests() ||
                $this->inExceptArray($request) ||
                $this->tokensMatch($request)
                ) {
                    return $this->addCookieToResponse($request, $next($request));
                }
            
                throw new TokenMismatchException();
        }
    
    }
}
