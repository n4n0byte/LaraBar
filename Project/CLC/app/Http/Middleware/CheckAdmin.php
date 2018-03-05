<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* @var $user \App\Model\UserModel */
        $user = session('user');
        if (!$user->getAdmin()) {
            return response('Forbidden', 403);
        }
        return $next($request);
    }
}
