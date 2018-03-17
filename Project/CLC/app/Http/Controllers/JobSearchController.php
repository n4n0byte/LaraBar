<?php

namespace App\Http\Controllers;

use App\Services\Business\JobSearchBusinessService as JobSearchBusinessService;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class JobSearchController extends Controller
{
    /* @var $service IJobSearchBusinessService */
    private $service;

    /**
     * @param Request $request
     * Input should include search term, filter, and page.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $this->service = JobSearchBusinessService::getInstance();
        // check input validity
        $this->validation($request);

        $map = ["Job Title" => "TITLE",
                "Description" => "DESCRIPTION",
                "Company" => "AUTHOR"
               ];

        // pass request->input to business service
        $jobs = $this->service->searchJobPost($request->input("term"), $map[$request->input("filter")],0);
        $data = ["searchResults" => $jobs];

        return view("home")->with($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function suggested()
    {
        $this->service = JobSearchBusinessService::getInstance();
        // TODO
        // get jobs based on user profile
        $data = [];
        return view()->with($data);
    }

    public function show($id)
    {
        $this->service = JobSearchBusinessService::getInstance();
        // select job by ID
        $job = $this->service->getJobPostById($id);

        // data to pass to view
        $data = [
            "job" => $job
        ];

        // go to job view page with job
        return view("view_job")->with($data);
    }

    private function validation(Request $request)
    {
        $rules = [
            'term' => 'Required|Between:1,30',
            'filter' => 'Required',
            //'page' => 'Required|Number'
        ];

        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            throw $ve;
        }
    }
}
