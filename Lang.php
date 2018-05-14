<?php

namespace App\Http\Middleware;

use Closure;

class Lang
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
        app()->setLocale(lang());
        /* session()->has('lang') ? app()->setLocale(session('lang')) : app()->setLocale('ar');  */
         // or /App::setLocale('ar');
        return $next($request);
    }
}
