<?php

namespace App\Services\Business;

use App\Model\JobModel;
use App\Services\BusinessInterfaces\IJobSearchBusinessService;
use App\Services\Data\JobSearchDataAccessService;

/**
 * Class JobSearchBusinessService
 * @package app\Services\Business
 */
class JobSearchBusinessService implements IJobSearchBusinessService
{

    private static $instance = null;
    private $jobSearchScv = null;

    /**
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
     * initializes JobSearch data access service
     * JobSearchBusinessService constructor.
     */
    private function __construct()
    {

        $this->jobSearchScv = new JobSearchDataAccessService();

    }

    /**
     * returns a JobModel that is associated with a specific id
     * @param int $id
     * @return JobModel
     */
    public function getJobPostById(int $id): JobModel
    {

        return $this->jobSearchScv->getJobPostById($id);

    }

    /**
     * returns jon post content, filtered by a specific criteria
     * @param string $criteria
     * @return array
     */
    public function getJobPostByDetails(string $criteria): array
    {
        return $this->jobSearchScv->getJobPostByDetails($criteria);
    }

    /**
     * returns
     * @param string $criteria
     * @param string $filter
     * @param int $page
     * @return array
     */
    public function searchJobPost(string $criteria, string $filter, int $page): array
    {
        return $this->jobSearchScv->searchJobPost($criteria, $filter, $page);
    }

    /**
     * @return array
     */
    public function getJobPosts(): array
    {
        return $this->jobSearchScv->getJobPosts();
    }


}