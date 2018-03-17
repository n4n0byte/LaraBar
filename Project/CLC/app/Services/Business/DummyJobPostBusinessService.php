<?php
/*
version 1.0

Connor/Ali
CST-256
March 16, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

namespace App\Services\Business;


use App\Model\JobModel;
use App\Services\BusinessInterfaces\IJobPostBusinessService;

class DummyJobPostBusinessService implements IJobPostBusinessService
{

    private static $instance = null;
    private $jobs = [];

    public static function getInstance(): DummyJobPostBusinessService
    {
        if (self::$instance == null) {
            self::$instance = new DummyJobPostBusinessService();
            $jobs = [new JobModel(0, "Computer", "Connor", "Boston",
                "Work with Computer", "Must know about computer", 30000),
                new JobModel(1, "Construction", "Connor", "Boston",
                    "Work with Construction", "Must know about Construction", 30000),
                new JobModel(2, "Law", "Connor", "Boston",
                    "Work with Law", "Must know about Law", 30000),
                new JobModel(3, "Art", "Connor", "Boston",
                    "Work with Art", "Must know about Art", 30000)];
        }

        return self::$instance;
    }

    public function getJobPostById($id): JobModel
    {
        return $this->jobs[$id];
    }

    public function getJobPostByDetails($criteria): array
    {
        $result = [];
        /* @var $job JobModel */
        foreach ($this->jobs as $job) {
            if (strpos($job->getDescription(), $criteria) ||
                strpos($job->getTitle(), $criteria) ||
                strpos($job->getAuthor(), $criteria))
                array_push($result, $job);
        }
        return $result;
    }

    public function getJobPosts(): array
    {
        return $this->jobs;
    }

    /**
     * @param string $criteria $criteria request->input("criteria")
     * @param string $filter
     * @param int $page
     * @return array
     */
    public function searchJobPost(string $criteria, string $filter, int $page): array
    {
        $resultsPerPage = 2;
        $searchResults = [];
        for ($i = $page++ * $resultsPerPage; count($searchResults) < $resultsPerPage; $i++) {
            if (strpos($this->jobs[$i]->getDescription(), $criteria) ||
                strpos($this->jobs[$i]->getTitle(), $criteria) ||
                strpos($this->jobs[$i]->getAuthor(), $criteria))
                array_push($result, $this->jobs[$i]);
        }
        return $searchResults;
    }
}