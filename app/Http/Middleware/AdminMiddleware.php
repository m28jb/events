<?php
namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->is_admin) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
?>