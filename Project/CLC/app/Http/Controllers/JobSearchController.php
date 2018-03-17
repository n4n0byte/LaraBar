<?php

namespace App\Http\Controllers;

use App\Services\BusinessInterfaces\IJobSearchBusinessService;
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
        // check input validity
        $this->validationForUpdate($request);

        // pass request->input to business service
        $jobs = $this->service->searchJobPost($request->input("criteria"), $request->input("filter"),-1);
        $data = ["searchResults" => $jobs];

        return view("")->with($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function suggested()
    {
        // TODO
        // get jobs based on user profile
        $data = [];
        return view()->with($data);
    }

    public function jobDescription($id)
    {
        // select job by ID
        $job = $this->service->getJobPostById($id);

        // data to pass to view
        $data = [
            "job" => $job
        ];

        // go to job view page with job
        return view()->with($data);
    }

    private function validationForUpdate(Request $request)
    {
        $rules = [
            'term' => 'Required|Between:1,30',
            'option' => 'Required',
            'page' => 'Required|Number'
        ];

        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            throw $ve;
        }
    }
}
