<?php

namespace App\Http\Controllers;

use App\Services\Business\JobSearchBusinessService as JobService;
use App\Services\BusinessInterfaces\IJobSearchBusinessService;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class JobSearchController extends Controller
{
    /* @var $service IJobSearchBusinessService */
    private $service;

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function search(Request $request)
    {
        try {
            $this->service = JobService::getInstance();

            // check input validity
            $this->validation($request);

            // pass request->input to business service
            $jobs = $this->service->searchJobPost($request->input("term"), $request->input('filter'), 0);
            $data = ["searchResults" => $jobs];

            return view("home")->with($data);
        } catch (ValidationException $ve) {
            throw $ve;
        } catch (Exception $e) {
            return redirect("error");
        }
    }

    /**
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($id)
    {
        try {
            $this->service = JobService::getInstance();
            // select job by ID
            $job = $this->service->getJobPostById($id);

            // data to pass to view
            $data = [
                "job" => $job
            ];

            // go to job view page with job
            return view("view_job")->with($data);
        } catch (ValidationException $ve) {
            throw $ve;
        } catch (Exception $e) {
            return redirect("error");
        }
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
