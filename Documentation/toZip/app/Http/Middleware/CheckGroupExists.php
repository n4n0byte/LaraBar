<?php

namespace App\Http\Middleware;

use App\Model\GroupModel;
use App\Services\Business\UserGroupsBusinessService;
use Closure;

class CheckGroupExists
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
        // get the groupId
        $params = $request->route()->parameters();
        $groupId = $params["groupId"];

        // see if user already in group
        $service = UserGroupsBusinessService::getInstance();
        $groups = $service->listGroupsForUser(session("user"));
        /* @var $group GroupModel */
        foreach ($groups as $group)
            if ($group->getId() == $groupId || $groupId < 0)
                return redirect()->action("UserGroupController@Index");
        return $next($request);
    }
}
