<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Middleware for verifying if the User is an administrator
 * Class CheckAdmin
 * @package App\Http\Middleware
 */
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

        // get user from session
        $user = session('user');

        // check user admin status
        if (!$user->getAdmin()) {
            return response('Forbidden', 403);
        }

        // continue on to route action
        return $next($request);
    }
}
