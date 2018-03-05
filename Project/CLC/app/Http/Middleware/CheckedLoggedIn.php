<?php

namespace App\Http\Middleware;

use App\Model\UserModel;
use Closure;

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
        if(is_null(session("user")) || !session("user") instanceof UserModel)
            return response("Session ended", 403);
        return $next($request);
    }
}
