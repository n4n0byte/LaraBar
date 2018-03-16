<?php
/**
 * Student Name: Connor Low
 * Course Number: CST-256
 * Date: 3/16/2018
 * This is my own work.
 */

namespace App\Services\Business;


use App\Model\JobModel;
use App\Services\BusinessInterfaces\IJobPostBusinessService;

class DummyJobPostBusinessService implements IJobPostBusinessService
{

    private static $instance = null;
    private $jobs = [];

    public static function getInstance(): IJobPostBusinessService
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

    public function createJobPost($data): bool
    {
        return array_push($this->jobs, new JobModel($data["id"], $data["title"], $data["author"], $data["location"],
            $data["description"], $data["requirements"], $data["salary"]));
    }

    public function deleteJobPost($id): bool
    {
        $len = count($this->jobs);
        $this->jobs[$id] = null;
        while ($id < $len) {
            $this->jobs[$id] = $this->jobs[++$id];
            $this->jobs[$id] = null;
        }
        return count($this->jobs) == $len - 1;
    }

    public function updateJobPost($data): bool
    {
        $this->jobs[$data["id"]] = new JobModel($data["id"], $data["title"], $data["author"],
            $data["location"], $data["description"], $data["requirements"], $data["salary"]);
        return true;
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
        // TODO: Implement getJobPosts() method.
    }

    public function searchJobPost($criteria, $page)
    {
        // TODO: Implement searchJobPost() method.
    }
}