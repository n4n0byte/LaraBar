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
    public static function getInstance() : IJobPostBusinessService;

    public function createJobPost($data) : bool;

    public function deleteJobPost($id) : bool;

    public function updateJobPost($data) : bool;

    public function getJobPostById($id) : JobModel;

    public function getJobPostByDetails($criteria) : array;

    public function getJobPosts() : array;
}