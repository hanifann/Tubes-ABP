<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Support\Facades\Auth; //
class CheckToken
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('token')) {
            // user value cannot be found in session
            return route('error.403');
        }

        return $next($request);
    }
}