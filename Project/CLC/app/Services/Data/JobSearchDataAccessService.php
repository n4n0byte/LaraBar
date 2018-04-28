<?php

namespace App\Services\Data;

use App\Model\JobModel;
use App\Services\DatabaseAccess;
use App\Services\Utility\LarabarLogger;
use PDO;
use PDOException;

class JobSearchDataAccessService
{

    private $conn, $ini;

    /**
     * JobSearchDataAccessService constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->conn = DatabaseAccess::connect();
        $this->ini = parse_ini_file("db.ini", true);
    }


    /**
     * used: 1
     * select rows from job post table with matching id
     * @param int $id
     * @return JobModel
     */
    public function getJobPostById(int $id): JobModel
    {
        LarabarLogger::info("-> JobSearchDataAccessService::getJobPostById");

        // declare array to hold job post
        $JobArr = [];

        // get query for selecting job post by id from ini
        $query = $this->ini['SearchUserGroups']['select.id'];
        $statement = $this->conn->prepare($query);

        // bind user id to id param
        $statement->bindParam(':userId', $id);
        try {

            // execute. Iterate through result and add to array.
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $job = new JobModel($row["ID"], $row["TITLE"], $row["AUTHOR"],
                    $row["LOCATION"], $row["DESCRIPTION"], $row["REQUIREMENTS"], $row["SALARY"]);
                array_push($JobArr, $job);
            }
        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::getJobs\n" . $e->getMessage());
        }

        // return job at index 0
        return $JobArr[0];
    }

    /**
     * @param string $criteria
     * @return array
     */
    public function getJobPostByDetails(string $criteria): array
    {

        return $this->searchJobPost($criteria, "TITLE");

    }

    /**
     * used: 1
     * Select rows from job post table matching criteria for a filter column
     * @param string $criteria
     * @param string $filter
     * @param int $page
     * @return array
     */
    public function searchJobPost(string $criteria, string $filter, int $page = 0): array
    {
        LarabarLogger::info("-> JobSearchDataAccessService::searchJobPost");

        // declare array to hold found jobs
        $JobArr = [];

        // get query from ini
        $query = $this->ini['SearchUserGroups']['select.criteria'] . " $filter like ?";
        $statement = $this->conn->prepare($query);
        try {

            // bind param array and execute
            $statement->execute(["%$criteria%"]);

            // iterate through fetched result assoc array and add job models to array
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $job = new JobModel($row["ID"], $row["TITLE"], $row["AUTHOR"],
                    $row["LOCATION"], $row["DESCRIPTION"], $row["REQUIREMENTS"], $row["SALARY"]);
                array_push($JobArr, $job);
            }
        } catch (PDOException $e) {
            LarabarLogger::error("JobSearchDataAccessService::searchJobPost error: " . $e);
            throw new PDOException("Exception in JobPostDAO::getJobs\n" . $e->getMessage());
        }

        // return array of job models
        return $JobArr;
    }

    /**
     * Used: 1
     * @throws PDOException
     * @return array
     */
    public function getJobPosts(): array
    {
        $JobArr = array();
        $query = $this->ini['SearchUserGroups']['select.all'];

        $statement = $this->conn->prepare($query);

        $statement->bindParam(":userId", $id);

        try {

            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $job = new JobModel($row["ID"], $row["TITLE"], $row["AUTHOR"],
                    $row["LOCATION"], $row["DESCRIPTION"], $row["REQUIREMENTS"], $row["SALARY"]);
                array_push($JobArr, $job);
            }


        } catch (PDOException $e) {
            throw new PDOException("Exception in JobPostDAO::getJobs\n" . $e->getMessage());
        }

        return $JobArr;

    }

}