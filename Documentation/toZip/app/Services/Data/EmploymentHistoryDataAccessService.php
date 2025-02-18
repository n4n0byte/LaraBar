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

use App\Model\EmploymentHistoryModel;
use App\Services\DatabaseAccess;
use PDO;
use PDOException;

class EmploymentHistoryDataAccessService
{

    private $conn, $ini;

    /**
     * UserDataAccessService constructor.
     */
    public function __construct()
    {
        $this->conn = DatabaseAccess::connect();
        $this->ini = parse_ini_file("db.ini", true);
    }

    public function createEmploymentHistoryRow(EmploymentHistoryModel $model)
    {
        $user = session()->get('user');
        $uid = $user->getID();
        $employer = $model->getEmployer();
        $position = $model->getPosition();
        $duration = $model->getDuration();

        $query = $this->ini['EmploymentHistory']['insert'];
        $statement = $this->conn->prepare($query);

        $statement->bindParam(":uid", $uid);
        $statement->bindParam(":employer", $employer);
        $statement->bindParam(":position", $position);
        $statement->bindParam(":duration", $duration);

        try {

            $result = $statement->execute();

        } catch (PDOException $e) {
            throw new PDOException("Exception in EmploymentHistoryDAO::create\n" . $e->getMessage());
        }

    }

    public function deleteEducationRow(int $id)
    {
        $query = $this->ini['EmploymentHistory']['delete'];
        $statement = $this->conn->prepare($query);

        $statement->bindParam("id", $id);

        try {

            $result = $statement->execute();

        } catch (PDOException $e) {
            throw new PDOException("Exception in EmploymentHistoryDAO::delete\n" . $e->getMessage());
        }

    }

    public function updateEmploymentHistoryRow(EmploymentHistoryModel $model)
    {

        $modelArr = array($model->getId(), $model->getUid(), $model->getEmployer(),
            $model->getPosition(), $model->getDuration());
        $query = $this->ini['EmploymentHistory']['update'];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":id", $modelArr[0]);
        $statement->bindParam(":employer", $modelArr[2]);
        $statement->bindParam(":position", $modelArr[3]);
        $statement->bindParam(":duration", $modelArr[4]);

        try {

            $result = $statement->execute();

        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::update\n" . $e->getMessage());
        }

    }


    public function getEmploymentHistoryRows($id = -1, $usePid = false)
    {

        $employmentHistoryArr = array();
        $query = $id === -1 ? $this->ini['EmploymentHistory']['select.all'] : $this->ini['EmploymentHistory']['select.id'];


        if ($usePid){
            $query = $this->ini['EmploymentHistory']['select.pid'];
        }

        $statement = $this->conn->prepare($query);

        if ($id !== -1) {
            $statement->bindParam(":id", $id);
        }


        try {

            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                //$id, $uid, $title, $author, $location, $description, $requirements, $salary
                $employmentHistoryRow = new EmploymentHistoryModel($row["ID"], $row["UID"], $row["EMPLOYER"], $row["POSITION"], $row["DURATION"]);
                array_push($employmentHistoryArr, $employmentHistoryRow);
            }


        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::getJobs\n" . $e->getMessage());
        }

        return $employmentHistoryArr;

    }

}