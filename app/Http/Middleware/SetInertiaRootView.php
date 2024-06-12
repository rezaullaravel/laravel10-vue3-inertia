<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SetInertiaRootView
{
    public function handle(Request $request, Closure $next, $view)
    {
        Inertia::setRootView($view);

        return $next($request);
    }
}
