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

use App\Model\SkillsModel;
use App\Services\DatabaseAccess;
use App\Services\Utility\LarabarLogger;
use PDO;
use PDOException;

class SkillsDataAccessService
{
    private $conn, $ini;

    /**
     * SkillsDataAccessService constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->conn = DatabaseAccess::connect();
        $this->ini = parse_ini_file("db.ini", true);
    }

    /**
     * used: 1
     * Insert new row into skill table
     * @param SkillsModel $model
     */
    public function createSkillRow(SkillsModel $model)
    {
        LarabarLogger::info("-> SkillsDataAccessService::createSkillRow");

        // get user id
        $uid = session()->get('UID');

        // get title and description from model
        $title = $model->getTitle();
        $description = $model->getDescription();

        // get ini sql skill insert statement
        $query = $this->ini['Skill']['insert'];
        $statement = $this->conn->prepare($query);

        // bind skill params
        $statement->bindParam(":uid", $uid);
        $statement->bindParam(":title", $title);
        $statement->bindParam(":description", $description);
        try {

            // execute insertion
            $result = $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Exception in SkillDAO::create\n" . $e->getMessage());
        }
    }

    public function deleteSkillRow(int $id)
    {
        $query = $this->ini['Skill']['delete'];
        $statement = $this->conn->prepare($query);

        $statement->bindParam("id", $id);

        try {

            $result = $statement->execute();

        } catch (PDOException $e) {
            throw new PDOException("Exception in SkillPostDAO::delete\n" . $e->getMessage());
        }

    }

    /**
     * used: 1
     * update a row in skill table based on skill id
     * @param SkillsModel $model
     */
    public function updateSkillRow(SkillsModel $model)
    {
        LarabarLogger::info("-> SkillsDataAccessService::updateSkillRow");

        // covert model to array accessible by PDO statement
        $modelArr = array($model->getId(), $model->getUid(), $model->getDescription(),
            $model->getTitle());
        $query = $this->ini['Skill']['update'];
        $statement = $this->conn->prepare($query);

        // bind skill params
        $statement->bindParam(":id", $modelArr[0]);
        $statement->bindParam(":description", $modelArr[2]);
        $statement->bindParam(":title", $modelArr[3]);
        try {

            // execute insertion
            $result = $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Exception in SkillsDAO::update\n" . $e->getMessage());
        }
    }

    /**
     * used: 1
     * Select rows from skills table
     * @param int $id
     * @param bool $usePid
     * @return array
     */
    public function getSkillRows($id = -1, $usePid = false)
    {
        LarabarLogger::info("-> SkillsDataAccessService::getSkillRows");

        // initialize array to hold skills
        $SkillArr = [];

        // Get query from ini:
        // If no id is set, select all. If usePid is set, select by post id, else by user id.
        if ($usePid) {
            $query = $this->ini['Skill']['select.pid'];
        } else
            $query = $id === -1 ? $this->ini['Skill']['select.all'] : $this->ini['Skill']['select.id'];
        $statement = $this->conn->prepare($query);

        // bind id param if necessary
        if ($id !== -1) {
            $statement->bindParam(":id", $id);
        }
        try {

            // execute selection
            // iterate through result assoc array and add skills to array
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                //$id, $uid, $title, $author, $location, $description, $requirements, $salary
                $SkillRow = new SkillsModel($row["ID"], $row["UID"], $row["TITLE"], $row["DESCRIPTION"]);
                array_push($SkillArr, $SkillRow);
            }
        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::getJobs\n" . $e->getMessage());
        }

        // return result array
        return $SkillArr;
    }


}