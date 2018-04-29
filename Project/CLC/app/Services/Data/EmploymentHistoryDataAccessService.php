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
use App\Services\Utility\LarabarLogger;
use PDO;
use PDOException;

/**
 * Class EmploymentHistoryDataAccessService
 * @package App\Services\Data
 */
class EmploymentHistoryDataAccessService
{

    private $conn, $ini;

    /**
     * EmploymentHistoryDataAccessService constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->conn = DatabaseAccess::connect();
        $this->ini = parse_ini_file("db.ini", true);
    }

    /**
     * used: 1
     * Insert row into employment history table
     * @param EmploymentHistoryModel $model
     */
    public function createEmploymentHistoryRow(EmploymentHistoryModel $model)
    {
        LarabarLogger::info("-> EmploymentHistoryDataAccessService::createEmploymentHistoryRow");

        // get user from
        $uid = session()->get('UID');

        // get fields from model
        $employer = $model->getEmployer();
        $position = $model->getPosition();
        $duration = $model->getDuration();

        // get insertion statement from ini
        $query = $this->ini['EmploymentHistory']['insert'];
        $statement = $this->conn->prepare($query);

        // bind employment history params
        $statement->bindParam(":uid", $uid);
        $statement->bindParam(":employer", $employer);
        $statement->bindParam(":position", $position);
        $statement->bindParam(":duration", $duration);
        try {

            // execute insertion
            $result = $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Exception in EmploymentHistoryDAO::create\n" . $e->getMessage());
        }
    }

    /**
     * used: 1
     * Delete a row from the employment history table.
     * @param int $id
     */
    public function deleteEmploymentRow(int $id)
    {
        LarabarLogger::info("-> EmploymentHistoryDataAccessService::deleteEmploymentRow");

        // get query from ini and bind id param for row id.
        $query = $this->ini['EmploymentHistory']['delete'];
        $statement = $this->conn->prepare($query);
        $statement->bindParam("id", $id);
        try {

            // execute deletion
            $result = $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Exception in EmploymentHistoryDAO::delete\n" . $e->getMessage());
        }
    }

    /**
     * used: 1
     * Update row in Employment history table
     * @param EmploymentHistoryModel $model
     */
    public function updateEmploymentHistoryRow(EmploymentHistoryModel $model)
    {
        LarabarLogger::info("-> EmploymentHistoryDataAccessService::updateEmploymentHistoryRow");

        // convert model to array accessible by PDO statement
        $modelArr = array($model->getId(), $model->getUid(), $model->getEmployer(),
            $model->getPosition(), $model->getDuration());
        $query = $this->ini['EmploymentHistory']['update'];
        $statement = $this->conn->prepare($query);

        // bind employment history params
        $statement->bindParam(":id", $modelArr[0]);
        $statement->bindParam(":employer", $modelArr[2]);
        $statement->bindParam(":position", $modelArr[3]);
        $statement->bindParam(":duration", $modelArr[4]);
        try {

            // execute update
            $result = $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::update\n" . $e->getMessage());
        }
    }

    /**
     * used: 1
     * Selects rows from the employment history table
     * @param int $id
     * @param bool $usePid
     * @return array
     */
    public function getEmploymentHistoryRows($id = -1, $usePid = false)
    {
        LarabarLogger::info("-> EmploymentHistoryDataAccessService::getEmploymentHistoryRows");

        // declare array to hold employment history models
        $employmentHistoryArr = [];

        // Get statement from ini:
        // If no id, select all rows. Else, if usePid is true, select by post id, else by user id.
        $query = $id === -1 ? $this->ini['EmploymentHistory']['select.all'] : $this->ini['EmploymentHistory']['select.id'];
        if ($usePid) {
            $query = $this->ini['EmploymentHistory']['select.pid'];
        }
        $statement = $this->conn->prepare($query);

        // bind id if necessary
        if ($id !== -1) {
            $statement->bindParam(":id", $id);
        }
        try {

            // Execute selection.
            // Iterate through assoc array to create and add employment history models to array
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                //$id, $uid, $title, $author, $location, $description, $requirements, $salary
                $employmentHistoryRow = new EmploymentHistoryModel($row["ID"], $row["UID"], $row["EMPLOYER"], $row["POSITION"], $row["DURATION"]);
                array_push($employmentHistoryArr, $employmentHistoryRow);
            }


        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::getJobs\n" . $e->getMessage());
        }

        // return employment history array
        return $employmentHistoryArr;

    }

}