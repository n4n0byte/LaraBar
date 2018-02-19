<?php
/*
version 1.0

Ali
CST-256
January 31, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
namespace App\Services\Data;

use App\Model\EducationModel;
use App\Services\DatabaseAccess;
use PDO;
use PDOException;

class EducationDataAccessService
{
    private $conn, $ini;

    /**
     * UserDataAccessService constructor.
     * @param $conn
     */
    public function __construct()
    {
        $this->conn = DatabaseAccess::connect();
        $this->ini = parse_ini_file("db.ini", true);
    }

    public function createEducationRow(EducationModel $model){
        $user = session()->get('user');
        $uid = $user->getID();
        $institution = $model->getInstitution();
        $level = $model->getLevel();
        $degree = $model->getDegree();

        $query = $this->ini['Education']['insert'];
        $statement = $this->conn->prepare($query);

        $statement->bindParam(":uid", $uid);
        $statement->bindParam(":institution", $institution);
        $statement->bindParam(":level", $level);
        $statement->bindParam(":degree", $degree);

        try {

            $result = $statement->execute();

        } catch (PDOException $e) {
            throw new PDOException("Exception in EducationDAO::create\n" . $e->getMessage());
        }

    }

    public function deleteEducationRow(int $id){
        $query = $this->ini['Education']['delete'];
        $statement = $this->conn->prepare($query);

        $statement->bindParam("id",$id);

        try {

            $result = $statement->execute();

        } catch (PDOException $e) {
            throw new PDOException("Exception in EducationPostDAO::delete\n" . $e->getMessage());
        }

    }

    public function updateEducationRow(EducationModel $model){

        $modelArr = array($model->getId(),$model->getUid(),$model->getInstitution(),
            $model->getLevel(),$model->getDegree());
        $query = $this->ini['Education']['update'];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":id", $modelArr[0]);
        $statement->bindParam(":institution", $modelArr[2]);
        $statement->bindParam(":level", $modelArr[3]);
        $statement->bindParam(":degree", $modelArr[4]);

        try {

            $result = $statement->execute();

        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::update\n" . $e->getMessage());
        }

    }


    public function getEducationRows($uid = -1){

        $educationArr = array();
        $query = $uid === -1 ? $this->ini['Education']['select.all'] : $this->ini['Education']['select.id'];
        $statement = $this->conn->prepare($query);

        if ($uid !== -1){
            $statement->bindParam(":uid", $uid);
        }

        try {

            $statement->execute();

            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                //$id, $uid, $title, $author, $location, $description, $requirements, $salary
                $educationRow = new EducationModel($row["ID"],$row["UID"],$row["INSTITUTION"],$row["LEVEL"],$row["DEGREE"]);
                array_push($educationArr,$educationRow);
            }


        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::getJobs\n" . $e->getMessage());
        }

        return $educationArr;

    }



}