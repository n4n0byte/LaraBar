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
use App\Services\Utility\LarabarLogger;
use PDO;
use PDOException;

class EducationDataAccessService
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

    public function createEducationRow(EducationModel $model)
    {
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

    public function deleteEducationRow(int $id)
    {
        $query = $this->ini['Education']['delete'];
        $statement = $this->conn->prepare($query);

        $statement->bindParam("id", $id);

        try {

            $result = $statement->execute();

        } catch (PDOException $e) {
            throw new PDOException("Exception in EducationPostDAO::delete\n" . $e->getMessage());
        }

    }

    /**
     * used: 1
     * Update or insert a row in education history table
     * @param EducationModel $model
     */
    public function updateEducationRow(EducationModel $model)
    {
        LarabarLogger::info("->EducationDataAccessService::updateEducationRow");

        // put model into array so values may be bound to PDO statement
        $modelArr = array($model->getId(), $model->getUid(), $model->getInstitution(),
            $model->getLevel(), $model->getDegree());
        $query = $this->ini['Education']['update'];

        // bind education parameters to query
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":id", $modelArr[0]);
        $statement->bindParam(":institution", $modelArr[2]);
        $statement->bindParam(":level", $modelArr[3]);
        $statement->bindParam(":degree", $modelArr[4]);
        try {

            // update execution
            $result = $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::update\n" . $e->getMessage());
        }
    }

    /**
     * used: 1
     * Select a row from the education table in the database
     * @param int $id
     * @param bool $usePostId
     * @return array
     */
    public function getEducationRows($id = -1, $usePostId = false)
    {
        LarabarLogger::info("-> EducationDataAccessService::getEducationRows");

        // declare array to hold retrieved education data
        $educationArr = array();

        // Select query statement from ini:
        // If an id is given, select by user id, or post id if set to true. Else, select all.
        $query = $id === -1 ? $this->ini['Education']['select.all'] : $this->ini['Education']['select.id'];
        if ($usePostId) {
            $query = $this->ini['Education']['select.pid'];
        }
        $statement = $this->conn->prepare($query);

        // bind id if necessary
        if ($id !== -1) {
            $statement->bindParam(":id", $id);
        }
        try {
            $statement->execute();

            // Retrieve rows as assoc array.
            // Loop through array and add education models to array.
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                //$id, $uid, $title, $author, $location, $description, $requirements, $salary
                $educationRow = new EducationModel($row["ID"], $row["UID"], $row["INSTITUTION"], $row["LEVEL"], $row["DEGREE"]);
                array_push($educationArr, $educationRow);
            }
        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::getJobs\n" . $e->getMessage());
        }

        // return education model array
        return $educationArr;
    }

}