<?php

namespace App\Http\Controllers;

use App\Services\Business\JobSearchBusinessService as JobService;
use App\Services\BusinessInterfaces\IJobSearchBusinessService;
use App\Services\Utility\ILogger;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class JobSearchController extends Controller
{
    /* @var $service IJobSearchBusinessService */
    private $service;
    private $logger;

    /**
     * JobSearchController constructor.
     * @param $logger
     */
    public function __construct(ILogger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Search for a job post
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function search(Request $request)
    {
        $this->logger->info("-> JobSearchController::search");
        try {

            // check input validity
            $this->validation($request);

            // pass request->input to business service
            $this->service = JobService::getInstance();
            $jobs = $this->service->searchJobPost($request->input("term"), $request->input('filter'), 0);

            // return home view with search results
            $data = ["searchResults" => $jobs];
            return view("home")->with($data);
        } catch (ValidationException $ve) {
            $this->logger->warning("JobSearchController validation exception " . $ve);
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("JobSearchController:: error: " . $e);
            return redirect("error");
        }
    }

    /**
     * Get job post by id
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($id)
    {
        $this->logger->info("-> JobSearchController::show");
        try {

            // pass job post id to service getter method
            $this->service = JobService::getInstance();
            $job = $this->service->getJobPostById($id);

            // data to pass to view
            $data = [
                "job" => $job
            ];

            // go to job view page with job
            return view("view_job")->with($data);
        } catch (ValidationException $ve) {
            $this->logger->warning("JobSearchController validation exception " . $ve);
            throw $ve;
        } catch (\Exception $e) {
            $this->logger->error("JobSearchController:: error: " . $e);
            return redirect("error");
        }
    }

    /**
     * Validate job post input
     * @param Request $request
     */
    private function validation(Request $request)
    {
        $this->logger->info("-> JobSearchController::validation");

        // define rules
        $rules = [
            'term' => 'Required|Between:1,30',
            'filter' => 'Required',
        ];

        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            throw $ve;
        }
    }
}
