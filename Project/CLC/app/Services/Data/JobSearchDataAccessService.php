<?php

namespace app\Services\Data;
use App\Model\JobModel;
use App\Services\DatabaseAccess;

class JobSearchDataAccessService {

    private $conn, $ini;

    /**
     * UserDataAccessService constructor.
     */
    public function __construct()
    {
        $this->conn = DatabaseAccess::connect();
        $this->ini = parse_ini_file("db.ini", true);
    }


    public function getJobPostById(int $id): JobModel {



    }

    public function getJobPostByDetails(string $criteria): array {
        // TODO: Implement getJobPostByDetails() method.
    }

    public function searchJobPost(string $criteria, string $filter, int $page): array {
        // TODO: Implement searchJobPost() method.
    }

    public function getJobPosts(): array {
        // TODO: Implement getJobPosts() method.
    }

}