<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 2/18/2018
 * Time: 9:12 AM
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

    public function addEmploymentHistory($employer, $position, $duration){

        $user = session()->get("user");
        $employmentHistoryModel = new EmploymentHistoryModel(-1,$user->getID(),$employer,$position,$duration);
        $this->employmentHistorySvc->createEmploymentHistoryRow($employmentHistoryModel);

    }

    public function removeEmploymentHistory(int $id){
        $this->employmentHistorySvc->deleteEducationRow($id);
    }

    public function getEmploymentHistory($id = -1){
        return $this->employmentHistorySvc->getEmploymentHistoryRows($id);
    }

    public function updateEmploymentHistory($id,$employer,$position,$duration){

        $user = session()->get("user");
        $employmentHistoryModel = new EmploymentHistoryModel($id,$user->getID(),$employer,$position,$duration);
        $this->employmentHistorySvc->updateEmploymentHistoryRow($employmentHistoryModel);

    }



}