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
use App\Model\EmploymentHistoryModel;
use App\Services\Data\EmploymentHistoryDataAccessService;

class EmploymentHistoryBusinessService
{

    private $employmentHistorySvc;

    /**
     * EmploymentHistoryBusinessService constructor.
     */
    public function __construct()
    {
        $this->employmentHistorySvc = new EmploymentHistoryDataAccessService();
    }

    /**
     * @param EmploymentHistoryModel $model
     */
    public function addEmploymentHistory(EmploymentHistoryModel $model)
    {

        $user = session()->get("user");
        $this->employmentHistorySvc->createEmploymentHistoryRow($model);

    }

    /**
     * @param int $id
     */
    public function removeEmploymentHistory(int $id)
    {
        $this->employmentHistorySvc->deleteEducationRow($id);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getEmploymentHistory($id = -1, $usePostId = false)
    {
        return $this->employmentHistorySvc->getEmploymentHistoryRows($id, $usePostId);
    }

    /**
     * @param EmploymentHistoryModel $model
     */
    public function updateEmploymentHistory(EmploymentHistoryModel $model)
    {

        $user = session()->get("user");
        if ($model->getId() > 0)
            $this->employmentHistorySvc->updateEmploymentHistoryRow($model);
        else
            $this->addEmploymentHistory($model);

    }


}