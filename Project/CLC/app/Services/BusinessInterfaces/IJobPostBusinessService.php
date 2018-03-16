<?php
/**
 * Student Name: Connor Low
 * Course Number: CST-256
 * Date: 3/16/2018
 * This is my own work.
 */

namespace App\Services\BusinessInterfaces;


use App\Model\JobModel;

interface IJobPostBusinessService
{
    public static function getInstance(): IJobPostBusinessService;

    public function createJobPost($data): bool;

    public function deleteJobPost($id): bool;

    public function updateJobPost($data): bool;

    // selects one job post
    public function getJobPostById($id): JobModel;

    // used to match jobs to a user
    public function getJobPostByDetails($criteria): array;

    // user to get search results
    public function searchJobPost($criteria, $page): array;

    // selects all job posts
    public function getJobPosts(): array;
}