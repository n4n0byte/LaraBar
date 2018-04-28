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

/**
 * Class SkillsDataAccessService
 * @package App\Services\Data
 */
class SkillsDataAccessService
{
    private $conn, $ini;

    /**
     * Used: 1
     * SkillsDataAccessService constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->conn = DatabaseAccess::connect();
        $this->ini = parse_ini_file("db.ini", true);
    }

    /**
     * Insert new row into skill table
     * Used: 1
     * @param SkillsModel $model
     */
    public function createSkillRow(SkillsModel $model)
    {
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

        // try to execute query
        try {

            // execute insertion
            $statement->execute();

        } // throw db error
        catch (PDOException $e) {
            throw new PDOException("Exception in SkillDAO::create\n" . $e->getMessage());
        }
    }

    /**
     * Used: 1
     * @param int $id
     */
    public function deleteSkillRow(int $id)
    {
        // select query
        $query = $this->ini['Skill']['delete'];
        $statement = $this->conn->prepare($query);

        //bind id param
        $statement->bindParam("id", $id);

        // try to execute delete query
        try {

            $statement->execute();

        } catch (PDOException $e) {
            throw new PDOException("Exception in SkillPostDAO::delete\n" . $e->getMessage());
        }

    }

    /**
     * <<<<<<< HEAD
     * used: 1
     * update a row in skill table based on skill id
     * =======
     * Used: 1
     * >>>>>>> 5a6862acae6ffd435bd2a63f05292f4345d9b140
     * @param SkillsModel $model
     */
    public function updateSkillRow(SkillsModel $model)
    {
        LarabarLogger::info("-> SkillsDataAccessService::updateSkillRow");

        // covert model to array accessible by PDO statement
        // fill arr with all model attributes
        $modelArr = array($model->getId(), $model->getUid(), $model->getDescription(),
            $model->getTitle());

        // select update query from ini
        $query = $this->ini['Skill']['update'];
        $statement = $this->conn->prepare($query);

        // bind skill params
        $statement->bindParam(":id", $modelArr[0]);
        $statement->bindParam(":description", $modelArr[2]);
        $statement->bindParam(":title", $modelArr[3]);

        // try to execute query
        try {
            $statement->execute();
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