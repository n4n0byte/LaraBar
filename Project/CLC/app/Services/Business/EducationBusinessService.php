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
use PDO;
use PDOException;

class EducationBusinessService{

    private $educationSvc;

    /**
     * EducationBusinessService constructor.
     * @param $educationSvc
     */
    public function __construct() {
        $this->educationSvc = new EducationDataAccessService();
    }


    public function insertEducation($institution,$level,$degree){

        $user = session()->get("user");
        $educationModel = new EducationModel(-1,$user->getID(),$institution,$level,$degree);
        $this->educationSvc->createEducationRow($educationModel);

    }

    public function deleteEducation(int $id){
        $this->educationSvc->deleteEducationRow($id);
    }

    public function getEducation($id = -1){
        return $this->educationSvc->getEducationRows($id);
    }

    public function updateEducation($id,$institution,$level,$degree){

        $user = session()->get("user");
        $educationModel = new EducationModel($id,$user->getID(),$institution,$level,$degree);
        $this->educationSvc->updateEducationRow($educationModel);

    }

}
