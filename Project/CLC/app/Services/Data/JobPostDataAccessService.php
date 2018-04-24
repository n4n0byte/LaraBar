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

use App\Model\JobModel;
use App\Services\DatabaseAccess;
use App\Services\Utility\LarabarLogger;
use PDO;
use PDOException;

class JobPostDataAccessService
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

    /**
     * used: 1
     * Add a new row to the job post table
     * @param $data
     */
    public function createJobPost($data)
    {
        LarabarLogger::info("-> JobPostDataAccessService::createJobPost");

        // get query from ini
        $query = $this->ini['Job']['insert'];
        $statement = $this->conn->prepare($query);

        // bind all params for job post (except id)
        $statement->bindParam(":title", $data["title"]);
        $statement->bindParam(":author", $data["author"]);
        $statement->bindParam(":location", $data["location"]);
        $statement->bindParam(":description", $data["description"]);
        $statement->bindParam(":requirements", $data["requirements"]);
        $statement->bindParam(":salary", $data["salary"]);

        // try to execute insertion
        try {
            $statement->execute();
        } catch (PDOException $e) {
            LarabarLogger::error("JobPostDataAccessService::createJobPost error " .
                $e->getMessage());
            throw new PDOException("Exception in JobPostDAO::create\n" . $e->getMessage());
        }

    }

    /**
     * used: 1
     * Delete row from job post table matching id
     * @param int $id
     */
    public function deleteJobPost(int $id)
    {
        LarabarLogger::info("-> JobPostDataAccessService::deleteJobPost");

        // get job delete query from ini
        $query = $this->ini['Job']['delete'];
        $statement = $this->conn->prepare($query);

        // bind id param
        $statement->bindParam("id", $id);

        // try to execute deletion
        try {
            $statement->execute();
        } catch (PDOException $e) {
            LarabarLogger::error("JobPostDataAccessService::deleteJobPost error " .
                $e->getMessage());
            throw new PDOException("Exception in JobPostDAO::delete\n" . $e->getMessage());
        }

    }

    /**
     * used: 1
     * Update row in job post table matching id
     * @param array $data
     */
    public function updateJobPost(array $data)
    {
        LarabarLogger::info("-> JobPostDataAccessService::updateJobPost");

        // get sql statement from ini
        $query = $this->ini['Job']['update'];

        // bind all params for job post
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":id", $data["id"]);
        $statement->bindParam(":title", $data["title"]);
        $statement->bindParam(":author", $data["author"]);
        $statement->bindParam(":location", $data["location"]);
        $statement->bindParam(":description", $data["description"]);
        $statement->bindParam(":requirements", $data["requirements"]);
        $statement->bindParam(":salary", $data["salary"]);

        // try to execute
        try {
            $statement->execute();
        } catch (PDOException $e) {
            LarabarLogger::error("JobPostDataAccessService::updateJobPost error " .
                $e->getMessage());
            throw new PDOException("Exception in JobPostDAO::update\n" . $e->getMessage());
        }

    }


    /**
     * Used: 1
     * Get all Job Post from database
     * @param int $id
     * @param bool $usePid
     * @return array
     */
    public function getJobs($id = -1, $usePid = false)
    {
        LarabarLogger::info("-> JobPostDataAccessService::getJobs(" .
            $id . "," . ($usePid ? "true)" : "false)"));

        // declare a job array
        $jobs = [];

        // determine sql statement to pull from ini (by post id, by user id, or all jobs)
        if ($usePid) {
            $query = $this->ini['Job']['select.pid'];
        } else {
            $query = $id === -1 ? $this->ini['Job']['select.all'] : $this->ini['Job']['select.id'];
        }
        $statement = $this->conn->prepare($query);

        // if not all jobs, bind id
        if ($id !== -1) {
            $statement->bindParam(":id", $id);
        }
        try {

            // get all relevant rows as an associative array; iterate through and add to job array
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                // JobModel needs: $id, $uid, $title, $author, $location, $description, $requirements, $salary
                $job = new JobModel($row["ID"], $row["TITLE"], $row["AUTHOR"],
                    $row["LOCATION"], $row["DESCRIPTION"], $row["REQUIREMENTS"], $row["SALARY"]);
                array_push($jobs, $job);
            }
        } catch (PDOException $e) {
            LarabarLogger::error("JobPostDataAccessService::getJobs error: " .
                $e->getMessage());
            throw new PDOException("Exception in JobPostDAO::getJobs\n" . $e->getMessage());
        }

        // return array
        return $jobs;
    }

}