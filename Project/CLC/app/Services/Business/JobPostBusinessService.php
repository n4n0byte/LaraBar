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
use Illuminate\Queue\Jobs\Job;

class JobPostBusinessService {

    private $jobSvc;

    /**
     * JobPostBusinessService constructor.
     * @param $jobSvc
     */
    public function __construct() {
        $this->jobSvc = new JobPostDataAccessService();
    }

    public function createJobPost($title,$location,$description,$requirements,$salary){
        $this->jobSvc->createJobPost([$title,$location,$description,$requirements,$salary]);
    }

    public function deleteJobPost($id){
        $this->jobSvc->deleteJobPost($id);
    }

    public function updateJobPost($id,$title,$location,$description,$requirements,$salary){
        $user = session()->get('user');
        $model = new JobModel($id, $user->getID(), $title, $user->getEmail(),$location,$description,$requirements,$salary);
        $this->jobSvc->updateJobPost($model);
    }

    public function getJobPosts($uid = -1, $usePid = false){
        return $this->jobSvc->getJobs($uid, $usePid);
    }

}