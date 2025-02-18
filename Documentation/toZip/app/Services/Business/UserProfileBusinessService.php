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
use App\User;

class UserProfileBusinessService
{
    /**
     * @return array
     */
    public function getProfileData()
    {
        $profile = new UserProfileDataAccessService();
        return $profile->read();
    }

    public function updateUserProfile(UserProfileModel $model)
    {
        $service = new UserProfileDataAccessService();
        $service->update($model);
    }

    public function initializeProfile(UserProfileModel $model)
    {
        $service = new UserProfileDataAccessService();
        $service->create($model);
    }

}