<?php

namespace App\Http\Middleware;

use App\Model\UserModel;
use Closure;

/**
 * Middleware for verifying if user is logged in
 * Class CheckedLoggedIn
 * @package App\Http\Middleware
 */
class CheckedLoggedIn
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

        // check if the user is in the session
        if(is_null(session("user")) || !session("user") instanceof UserModel)

            // TODO change to send to a custom error view.
            return redirect("login");

        // continue on to route action
        return $next($request);
    }
}
