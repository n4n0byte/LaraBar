<?php

namespace App\Http\Controllers;

use App\Model\DTO;
use App\Services\Business\JobPostBusinessService;
use App\Services\Business\JobSearchBusinessService;

class JobRestController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $jobBusSvc = new JobPostBusinessService();
        $results = $jobBusSvc->getJobPosts();

        $message = "success";

        if (count($results) > 99){
            $message = "warning over 100 rows requested, returned exactly ";
        }

        $dto = new DTO(200,$message,$results);
        return json_encode($dto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $statusCode = 200;
        $message = "success";
        $dto = null;
        $jobBusSvc = new JobPostBusinessService();
        $results = $jobBusSvc->getJobPosts($id,true);

        if (count($results) > 0){

            $dto = new DTO($statusCode,$message,$results);
        }
        else {
            $statusCode = 404;
            $message = "No job post with that id";
            $dto = new DTO($statusCode, $message);
        }

        return json_encode($dto);
    }

    /**
     * @param $show
     * @return DTO|null
     */
    public function searchByName($show){

        $dto = null;

        $searchSvc = JobSearchBusinessService::getInstance();

        $results = $searchSvc->getJobPostByDetails($show);

        if (count($results) > 0){
            $dto = new DTO(200,"success", $results);
        }
        else {
            $dto = new DTO(404,"No job post with that name (empty)");
        }

        return $dto;
    }


}
