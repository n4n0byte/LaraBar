<?php

namespace App\Http\Controllers;

use App\Model\DTO;
use App\Services\Business\JobPostBusinessService;
use App\Services\Business\JobSearchBusinessService;

/**
 * Responsible for returning json encoded job posts
 * within a json encoded DTO object
 * Class JobRestController
 * @package App\Http\Controllers
 */
class JobRestController extends Controller
{

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     * @throws \Exception
     */
    public function index()
    {

        $dto = null;
        $message = "success";
        $statusCode = 200;

        // try to create DTO with requested data
        try {

            $jobBusSvc = new JobPostBusinessService();
            $results = $jobBusSvc->getJobPosts();

            // check if results size is over, 100
            if (count($results) == 100) {
                $message = "Ok, first 100 rows returned";
                $statusCode = 206;
            }
            // check if any jobs is found
            elseif ($results == null){
                $statusCode = 404;
                $message = "Not Found";
                $results = [];
            }

        } catch (\Exception $e) {
            $statusCode = 500;
            $message = "It broke";
            $results = [];
        }

        return json_encode(new DTO($statusCode,$message,$results));
    }

    /**
     * Display the specified resource.
     * Gets a job by Job Post ID
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // try to return dto with job
        // info
        try {

            $statusCode = 200;
            $message = "success";
            $dto = null;
            $jobBusSvc = new JobPostBusinessService();
            $results = $jobBusSvc->getJobPosts($id, true);

            // insert job into array
            if (count($results) > 0) {
                $dto = new DTO($statusCode, $message, $results);
            }
            // return empty array with corresponding dto
            else {
                $statusCode = 404;
                $message = "No job post with that id";
                $dto = new DTO($statusCode, $message);
            }

            return json_encode($dto);
        }
        // return dto with error message
        catch (\Exception $e) {
            $dto = new DTO(500, "It broke", []);
            return json_encode($dto);
        }
    }

    /**
     * @param $show
     * @return DTO|null
     */
    public function searchByName($show)
    {
        $dto = null;

        // try to return dto with Array of jobs
        try {
            $searchSvc = JobSearchBusinessService::getInstance();

            $results = $searchSvc->getJobPostByDetails($show);

            if (count($results) > 0) {
                $dto = new DTO(200, "success", $results);
            } else {
                $dto = new DTO(404, "No job post with that name \" {$show} \" (empty)");
            }

        }
        // make dto with error
        catch (\Exception $e) {
            $dto = new DTO(500, "It broke", []);
        }
        return json_encode($dto);
    }


}
