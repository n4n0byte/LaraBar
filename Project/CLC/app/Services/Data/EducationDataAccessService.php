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
            throw new PDOException("Exception in JobPostDAO::create\n" . $e->getMessage());
        }

    }

    public function deleteJobPost(int $id){
        $query = $this->ini['Job']['delete'];
        $statement = $this->conn->prepare($query);

        $statement->bindParam("id",$id);

        try {

            $result = $statement->execute();

        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::delete\n" . $e->getMessage());
        }

    }

    public function updateJobPost(JobModel $model){

        $modelArr = array($model->getId(),$model->getUid(),$model->getTitle(),
            $model->getAuthor(),$model->getLocation(),$model->getDescription(),
            $model->getRequirements(),(int)$model->getSalary());
        $query = $this->ini['Job']['update'];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":id", $modelArr[0]);
        $statement->bindParam(":title",$modelArr[2]);
        $statement->bindParam(":author",$modelArr[3]);
        $statement->bindParam(":location",$modelArr[4]);
        $statement->bindParam(":description",$modelArr[5]);
        $statement->bindParam(":requirements",$modelArr[6]);
        $statement->bindParam(":salary",$modelArr[7]);

        try {

            $result = $statement->execute();

        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::update\n" . $e->getMessage());
        }

    }


    public function getJobs($uid = -1){

        $jobs = array();
        $query = $uid === -1 ? $this->ini['Job']['select.all'] : $this->ini['Job']['select.id'];
        $statement = $this->conn->prepare($query);

        if ($uid !== -1){
            $statement->bindParam(":uid", $uid);
        }

        try {

            $statement->execute();

            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                //$id, $uid, $title, $author, $location, $description, $requirements, $salary
                $job = new JobModel($row["ID"],$row["UID"],$row["TITLE"],$row["AUTHOR"],
                    $row["LOCATION"],$row["DESCRIPTION"], $row["REQUIREMENTS"],$row["SALARY"]);
                array_push($jobs,$job);
            }


        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::getJobs\n" . $e->getMessage());
        }

        return $jobs;

    }

}