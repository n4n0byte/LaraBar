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

class SkillsBusinessService
{

    private $SkillSvc;

    /**
     * SkillBusinessService constructor.
     */
    public function __construct()
    {
        $this->SkillSvc = new SkillsDataAccessService();
    }

    /**
     * @param SkillsModel $model
     */
    public function insertSkill(SkillsModel $model)
    {
        /* @var $model SkillsModel */
        $user = session()->get("user");
        $SkillsModel = new SkillsModel(-1, $user->getID(), $model->getTitle(), $model->getDescription());
        $this->SkillSvc->createSkillRow($SkillsModel);
    }

    /**
     * @param int $id
     */
    public function deleteSkill(int $id)
    {
        $this->SkillSvc->deleteSkillRow($id);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getSkill($id = -1)
    {
        return $this->SkillSvc->getSkillRows($id);
    }

    /**
     * @param SkillsModel $model
     */
    public function updateSkill(SkillsModel $model)
    {

        $user = session()->get("user");
        $SkillsModel = new SkillsModel(-1, $user->getID(), $model->getTitle(), $model->getDescription());
        $this->SkillSvc->updateSkillRow($SkillsModel);

    }

}
