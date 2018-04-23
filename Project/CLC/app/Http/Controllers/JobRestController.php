<?php

namespace App\Http\Controllers;

use App\Model\DTO;
use App\Services\Business\JobPostBusinessService;
use App\Services\Business\JobSearchBusinessService;

class JobRestController extends Controller
{

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     * @throws \Exception
     */
    public function index()
    {

        try {

            $jobBusSvc = new JobPostBusinessService();
            $results = $jobBusSvc->getJobPosts();
            $statusCode = -1;

            $dto = new DTO();

            $message = "success";

            // check if 100
            if (count($results) == 100) {
                $message = "Ok, first 100 rows returned";
                $statusCode = 206;
                
            }
            elseif ($results != null){

            }

            $dto = new DTO(200, $message, $results);
            return json_encode($dto);
        } catch (\Exception $e) {
            $dto = new DTO(500, "It broke", []);
            return json_encode($dto);
        }

        return json_encode($dto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $statusCode = 200;
            $message = "success";
            $dto = null;
            $jobBusSvc = new JobPostBusinessService();
            $results = $jobBusSvc->getJobPosts($id, true);

            if (count($results) > 0) {

                $dto = new DTO($statusCode, $message, $results);
            } else {
                $statusCode = 404;
                $message = "No job post with that id";
                $dto = new DTO($statusCode, $message);
            }

            return json_encode($dto);
        } catch (\Exception $e) {
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

        try {

            $searchSvc = JobSearchBusinessService::getInstance();

            $results = $searchSvc->getJobPostByDetails($show);

            if (count($results) > 0) {
                $dto = new DTO(200, "success", $results);
            } else {
                $dto = new DTO(404, "No job post with that name (empty)");
            }

        } catch (\Exception $e) {
            $dto = new DTO(500, "It broke", []);
        }
        return json_encode($dto);
    }


}
