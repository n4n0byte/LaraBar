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
use App\Services\Business\UserBusinessService;
use App\Services\DatabaseAccess;
use PDOException;
use PDO;
use App\Model\JobModel;
use App\Model\UserModel;

class JobPostDataAccessService {

    private $conn, $ini;

    /**
     * UserDataAccessService constructor.
     */
    public function __construct() {
        $this->conn = DatabaseAccess::connect();
        $this->ini = parse_ini_file("db.ini", true);
    }

    public function createJobPost($data){
        $user = session()->get('user');
        $uid = $user->getID();
        $author = $user->getEmail();
        $query = $this->ini['Job']['insert'];
        $statement = $this->conn->prepare($query);

        $statement->bindParam(":uid", $uid);
        $statement->bindParam(":title",$data[0]);
        $statement->bindParam(":author",$author);
        $statement->bindParam(":location",$data[1]);
        $statement->bindParam(":description",$data[2]);
        $statement->bindParam(":requirements",$data[3]);
        $statement->bindParam(":salary",$data[4]);


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


    public function getJobs($id = -1, $usePid = false){

        $jobs = array();
        $query = $id === -1 ? $this->ini['Job']['select.all'] : $this->ini['Job']['select.id'];

        if ($id > -1 && $usePid){
            $query = $this->ini['Job']['select.pid'];
        }

        $statement = $this->conn->prepare($query);

        if ($id !== -1) {
            $statement->bindParam(":id", $id);
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