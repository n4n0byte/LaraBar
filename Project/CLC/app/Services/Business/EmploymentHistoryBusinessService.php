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


use App\Model\EmploymentHistoryModel;
use App\Services\Data\EmploymentHistoryDataAccessService;

class EmploymentHistoryBusinessService {

    private $employmentHistorySvc;

    /**
     * EmploymentHistoryBusinessService constructor.
     * @param $jobSvc
     */
    public function __construct() {
        $this->employmentHistorySvc = new EmploymentHistoryDataAccessService();
    }

    public function addEmploymentHistory($employer, $position, $duration) {

        $user = session()->get("user");
        $employmentHistoryModel = new EmploymentHistoryModel(-1, $user->getID(), $employer, $position, $duration);
        $this->employmentHistorySvc->createEmploymentHistoryRow($employmentHistoryModel);

    }

    public function removeEmploymentHistory(int $id) {
        $this->employmentHistorySvc->deleteEducationRow($id);
    }

    public function getEmploymentHistory($id = -1) {
        return $this->employmentHistorySvc->getEmploymentHistoryRows($id);
    }

    public function updateEmploymentHistory($id, $employer, $position, $duration) {

        $user = session()->get("user");
        $employmentHistoryModel = new EmploymentHistoryModel($id, $user->getID(), $employer, $position, $duration);
        $this->employmentHistorySvc->updateEmploymentHistoryRow($employmentHistoryModel);

    }


}