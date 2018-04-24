<?php
/*
version 1.0

Ali
CST-256
January 31, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

namespace App\Services\Business;

use App\Model\JobModel;
use \App\Services\Data\JobPostDataAccessService;
use App\Services\Utility\LarabarLogger;
use Illuminate\Queue\Jobs\Job;

class JobPostBusinessService
{

    private $jobSvc;

    /**
     * JobPostBusinessService constructor.
     */
    public function __construct()
    {
        $this->jobSvc = new JobPostDataAccessService();
    }

    /**
     * used: 1
     * Insert a new job post into the database
     * @param array $data
     */
    public function createJobPost(array $data)
    {
        LarabarLogger::info("-> JobPostBusinessService::createJobPost");

        // call data access service method
        $this->jobSvc->createJobPost($data);
    }

    /**
     * Delete a job post from the database
     * @param $id
     */
    public function deleteJobPost($id)
    {
        LarabarLogger::info("-> JobPostBusinessService::deleteJobPost");
        $this->jobSvc->deleteJobPost($id);
    }

    /**
     * used: 1
     * Update a job post in database
     * @param array $data
     */
    public function updateJobPost(array $data)
    {
        LarabarLogger::info("-> JobPostBusinessService::updateJobPost");
        $this->jobSvc->updateJobPost($data);
    }


    /**
     * Used: 1
     * Get all Job Posts
     * @param int $uid
     * @param bool $usePid
     * @return array
     */
    public function getJobPosts($uid = -1, $usePid = false)
    {
        LarabarLogger::info("-> JobPostBusinessService::getJobPosts");
        return $this->jobSvc->getJobs($uid, $usePid);
    }

}