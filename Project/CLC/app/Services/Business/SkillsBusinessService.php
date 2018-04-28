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

use App\Model\SkillsModel;
use App\Services\Data\SkillsDataAccessService;
use App\Services\Utility\LarabarLogger;

class SkillsBusinessService
{

    private $SkillSvc;

    /**
     * Used: 5
     * SkillBusinessService constructor.
     */
    public function __construct()
    {
        $this->SkillSvc = new SkillsDataAccessService();
    }

    /**
     * create new skill in database
     * Used: 1
     * @param SkillsModel $model
     */
    public function insertSkill(SkillsModel $model)
    {
        LarabarLogger::info("-> SkillsBusinessService::insertSkill");

        // call service method
        $this->SkillSvc->createSkillRow($model);
    }

    /**
     * Used: 1
     * @param int $id
     */
    public function deleteSkill(int $id)
    {
        $this->SkillSvc->deleteSkillRow($id);
    }

    /**
     * used: 2
     * Get skills from database
     * Used: 3
     * @param int $id
     * @param bool $usePostId
     * @return array
     */
    public function getSkill($id = -1, $usePostId = false)
    {
        LarabarLogger::info("-> SkillsBusinessService::getSkill");
        return $this->SkillSvc->getSkillRows($id, $usePostId);
    }

    /**
     * <<<<<<< HEAD
     * used: 1
     * Update a skill the database
     * =======
     * Used: 1
     * >>>>>>> 5a6862acae6ffd435bd2a63f05292f4345d9b140
     * @param SkillsModel $model
     */
    public function updateSkill(SkillsModel $model)
    {
        LarabarLogger::info("-> SkillsBusinessService::updateSkill");

        // call service method
        $this->SkillSvc->updateSkillRow($model);
    }

}
