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

use App\Model\EducationModel;
use App\Services\Data\EducationDataAccessService;
use App\Services\Utility\LarabarLogger;

class EducationBusinessService
{

    private $educationSvc;

    /**
     * EducationBusinessService constructor.
     */
    public function __construct()
    {
        $this->educationSvc = new EducationDataAccessService();
    }

    /**
     * @param $institution
     * @param $level
     * @param $degree
     */
    public function insertEducation($institution, $level, $degree)
    {
        $user = session()->get("user");
        $educationModel = new EducationModel(-1, $user->getID(), $institution, $level, $degree);
        $this->educationSvc->createEducationRow($educationModel);
    }

    /**
     * @param int $id
     */
    public function deleteEducation(int $id)
    {
        $this->educationSvc->deleteEducationRow($id);
    }

    /**
     * used: 2
     * Get Education components for a user profile.
     * @param int $id
     * @param bool $usePostId
     * @return array
     */
    public function getEducation($id = -1, $usePostId = false)
    {
        LarabarLogger::info("-> UserProfileBusinessService::getProfileData");

        // Get education model array from data access service. Pass user ID
        return $this->educationSvc->getEducationRows($id, $usePostId);
    }

    /**
     * used: 2
     * Update User Education in database.
     * @param EducationModel $model
     */
    public function updateEducation(EducationModel $model)
    {
        LarabarLogger::info("-> UserProfileBusinessService::updateEducation");

        // If model id is greater than 0, action is an update. Else, is insertion: use create method.
        if ($model->getId() > 0)
            $this->educationSvc->updateEducationRow($model);
        else
            $this->educationSvc->createEducationRow($model);
    }

}
