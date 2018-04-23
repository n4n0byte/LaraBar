<?php
/*
version 1.1

Connor, Ali
CST-256
February 4, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

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
     * @throws \Exception
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
     * @throws \Exception
     */
    public function reactivate(UserModel $user)
    {
        $conn = DatabaseAccess::connect();
        $service = new SuspendUserDataAccessService($conn);
        return $service->reactivate($user);
    }

    /**
     * check to see if a user is suspended (TRUE for suspended)
     * @param $user
     * @return bool
     * @throws \Exception
     */
    public function suspensionStatus($user)
    {
        $conn = DatabaseAccess::connect();
        $service = new SuspendUserDataAccessService($conn);
        return $service->checkSuspended($user);
    }
}