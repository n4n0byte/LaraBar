<?php
namespace app\Services\Business;
use App\Model\JobModel;
use App\Services\BusinessInterfaces\IJobPostBusinessService;
use App\Services\BusinessInterfaces\IJobSearchBusinessService;


/**
 * Class JobSearchBusinessService
 * @package app\Services\Business
 */
class JobSearchBusinessService implements IJobSearchBusinessService {
    public static function getInstance(): IJobPostBusinessService {
        // TODO: Implement getInstance() method.
    }

    public function getJobPostById(int $id): JobModel {
        // TODO: Implement getJobPostById() method.
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