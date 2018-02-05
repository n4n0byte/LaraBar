<?php

namespace App\Services\Business;

use App\Model\UserModel;
use App\Services\Data\SuspendUserDataAccessService;
use App\Services\DatabaseAccess;

class SuspendUserBusinessService
{
    /**
     * Suspend a user if they are not suspended
     * @param UserModel $user
     * @return bool
     */
    public function suspend(UserModel $user)
    {
        $conn = DatabaseAccess::connect();
        $service = new SuspendUserDataAccessService($conn);

        // check for existing suspension
        if ($service->checkSuspended($user))
            return FALSE;

        // suspend
        return $service->suspend($user);
    }

    /**
     * attempt to reactivate a user
     * @param UserModel $user
     * @return bool
     */
    public function reactivate(UserModel $user)
    {
        $conn = DatabaseAccess::connect();
        $service = new SuspendUserDataAccessService($conn);
        return $service->reactivate($user);
    }

    /**
     * check to see if a user is suspended
     * @param $user
     * @return bool
     */
    public function suspensionStatus($user)
    {
        $conn = DatabaseAccess::connect();
        $service = new SuspendUserDataAccessService($conn);
        return $service->checkSuspended($user);
    }
}