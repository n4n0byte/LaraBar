<?php

/*
version 1.0

Ali
CST-256
January 31, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

namespace App\Services\Business;

use App\Model\UserProfileModel;
use App\Services\Data\UserProfileDataAccessService;
use App\Services\Utility\LarabarLogger;

/**
 * Class UserProfileBusinessService
 * @package App\Services\Business
 */
class UserProfileBusinessService
{
    /**
     * used: 3+
     * get a user profile from the database
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function getProfileData($id)
    {
        LarabarLogger::info("->UserProfileBusinessService::getProfileData");
        $profile = new UserProfileDataAccessService();
        return $profile->read($id);
    }

    public function getProfileById($id)
    {
        $profile = new UserProfileDataAccessService();
        return $profile->getDataById($id);
    }

    /**
     * used: 2
     * Update a user profile in the database
     * @param UserProfileModel $model
     * @throws \Exception
     */
    public function updateUserProfile(UserProfileModel $model)
    {
        LarabarLogger::info("-> UserProfileBusinessService::updateUserProfile");

        // call update method from service and pass model
        $service = new UserProfileDataAccessService();
        $service->update($model);
    }

    public function initializeProfile(UserProfileModel $model)
    {
        $service = new UserProfileDataAccessService();
        $service->create($model);
    }

}