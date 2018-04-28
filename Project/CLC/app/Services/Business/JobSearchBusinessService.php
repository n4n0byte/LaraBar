<?php

namespace App\Services\Business;

use App\Model\JobModel;
use App\Services\BusinessInterfaces\IJobSearchBusinessService;
use App\Services\Data\JobSearchDataAccessService;
use App\Services\Utility\LarabarLogger;
use Mockery\Exception;

/**
 * Class JobSearchBusinessService
 * @package app\Services\Business
 */
class JobSearchBusinessService implements IJobSearchBusinessService
{

    private static $instance = null;
    private $jobSearchScv = null;

    /**
     * Used: 3
     * returns single instance of Job search serviec
     * @return IJobSearchBusinessService
     */
    public static function getInstance(): IJobSearchBusinessService
    {

        if (self::$instance == null) {
            self::$instance = new JobSearchBusinessService();
        }

        return self::$instance;

    }

    /**
     * Used: 3
     * initializes JobSearch data access service
     * JobSearchBusinessService constructor.
     */
    private function __construct()
    {

        $this->jobSearchScv = new JobSearchDataAccessService();

    }

    /**
     * used: 1
     * returns a JobModel that is associated with a specific id
     * @param int $id
     * @return JobModel
     */
    public function getJobPostById(int $id): JobModel
    {
        LarabarLogger::info("-> JobSearchBusinessService::searchJobPost");

        // get job model from database using data access service method
        return $this->jobSearchScv->getJobPostById($id);
    }

    /**
     *
     * returns jon post content, filtered by a specific criteria
     * @param string $criteria
     * @return array
     */
    public function getJobPostByDetails(string $criteria): array
    {
        return $this->jobSearchScv->getJobPostByDetails($criteria);
    }

    /**
     * used: 1
     * Searches database for job posts based on user criteria
     * @param string $criteria
     * @param string $filter
     * @param int $page
     * @return array
     */
    public function searchJobPost(string $criteria, string $filter, int $page): array
    {
        LarabarLogger::info("-> JobSearchBusinessService::searchJobPost");

        // map input values for filter to column names for database search
        $map = ["Job Title" => "TITLE",
            "Description" => "DESCRIPTION",
            "Company" => "AUTHOR"
        ];

        // make sure given filter exists
        if (!array_key_exists($filter, $map)) {
            throw new Exception("You did something bad.");
        }

        // pass user search term and filter to data access service. Return resulting job model array.
        return $this->jobSearchScv->searchJobPost($criteria, $map[$filter], $page);
    }

    /**
     * @return array
     */
    public function getJobPosts(): array
    {
        return $this->jobSearchScv->getJobPosts();
    }


}