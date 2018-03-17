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

    // selects one job post
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