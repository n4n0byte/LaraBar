<?php
/**
 * Student Name: Connor Low
 * Course Number: CST-256
 * Date: 3/16/2018
 * This is my own work.
 */

namespace App\Services\BusinessInterfaces;


use App\Model\JobModel;

/**
 * Interface for Job Post Business Services
 * Interface IJobPostBusinessService
 * @package App\Services\BusinessInterfaces
 */
interface IJobPostBusinessService
{

    /**
     * @return IJobPostBusinessService
     */
    public static function getInstance(): IJobPostBusinessService;

    /**
     * @param $data
     * @return bool
     */
    public function createJobPost($data): bool;

    /**
     * @param $id
     * @return bool
     */
    public function deleteJobPost($id): bool;

    /**
     * expects request->input() assoc array
     * @param $data
     * @return bool
     */
    public function updateJobPost($data): bool;

    // selects one job post
    public function getJobPostById($id): JobModel;

    // used to match jobs to a user
    public function getJobPostByDetails($criteria): array;

    // user to get search results
    /**
     * @param string $criteria
     * @param string $filter
     * @param int $page
     * @return array
     */
    public function searchJobPost(string $criteria, string $filter, int $page): array;

    /**
     * @return array
     */
    public function getJobPosts(): array;
}