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
use PDO;
use PDOException;

class SkillsDataAccessService
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

    public function createSkillRow(SkillsModel $model)
    {
        $user = session()->get('user');
        $uid = $user->getID();
        // TODO getters
        $title = $model->getTitle();
        $description = $model->getDescription();

        $query = $this->ini['Skill']['insert'];
        $statement = $this->conn->prepare($query);

        $statement->bindParam(":uid", $uid);
        $statement->bindParam(":title", $title);
        $statement->bindParam(":description", $description);

        try {

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

    public function updateSkillRow(SkillsModel $model)
    {

        $modelArr = array($model->getId(), $model->getUid(), $model->getDescription(),
            $model->getTitle());
        $query = $this->ini['Skill']['update'];
        $statement = $this->conn->prepare($query);

        $statement->bindParam(":id", $modelArr[0]);
        $statement->bindParam(":description", $modelArr[2]);
        $statement->bindParam(":title", $modelArr[3]);

        try {

            $result = $statement->execute();

        } catch (PDOException $e) {
            throw new PDOException("Exception in SkillsDAO::update\n" . $e->getMessage());
        }

    }


    public function getSkillRows($id = -1, $usePid = false)
    {

        $SkillArr = array();
        $query = $id === -1 ? $this->ini['Skill']['select.all'] : $this->ini['Skill']['select.id'];

        if ($usePid){
            $query = $this->ini['Skill']['select.pid'];
        }

        $statement = $this->conn->prepare($query);


        if ($id !== -1) {
            $statement->bindParam(":id", $id);
        }

        try {

            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                // TODO
                //$id, $uid, $title, $author, $location, $description, $requirements, $salary
                $SkillRow = new SkillsModel($row["ID"], $row["UID"], $row["TITLE"], $row["DESCRIPTION"]);
                array_push($SkillArr, $SkillRow);
            }


        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::getJobs\n" . $e->getMessage());
        }

        return $SkillArr;

    }


}