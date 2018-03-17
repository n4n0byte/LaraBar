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
interface IJobSearchBusinessService
{

    /**
     * @return IJobSearchBusinessService
     */
    public static function getInstance(): IJobSearchBusinessService;

    /**
     * returns a job post by id
     * @param int $id
     * @return JobModel
     */
    public function getJobPostById(int $id): JobModel;

    /**
     * returns job search
     * @param $criteria
     * @return array
     */
    public function getJobPostByDetails(string $criteria): array;


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