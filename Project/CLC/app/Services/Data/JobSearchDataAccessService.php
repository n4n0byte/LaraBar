<?php

namespace App\Services\Data;

use App\Model\JobModel;
use App\Services\DatabaseAccess;
use PDO;
use PDOException;

class JobSearchDataAccessService
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
     * @param int $id
     * @return JobModel
     */
    public function getJobPostById(int $id): JobModel
    {
        $JobArr = array();
        $query = $this->ini['SearchUserGroups']['select.id'];

        $statement = $this->conn->prepare($query);

        $statement->bindParam(':userId', $id);

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

    public function searchJobPost(string $criteria, string $filter, int $page = 0): array
    {

        $JobArr = array();
        $query = $this->ini['SearchUserGroups']['select.criteria'] . " $filter like ?";


        $statement = $this->conn->prepare($query);


        // $statement->bindParam(":filter", $filter);

        try {

            $statement->execute(array("%$criteria%"));

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