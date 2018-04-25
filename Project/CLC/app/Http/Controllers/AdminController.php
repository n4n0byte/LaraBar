<?php

namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Services\Business\JobPostBusinessService;
use App\Services\Business\SuspendUserBusinessService;
use App\Services\Business\UserBusinessService;
use App\Services\Utility\LarabarLogger;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Mockery\Exception;

class AdminController extends Controller
{
    /**
     * Render the admin view
     * @param int $toolId
     * @param string $message
     * @return $this
     */
    public function index($toolId = -1, $message = null)
    {
        LarabarLogger::info("-> AdminController::index");
        try {
            // get users list from database
            $userService = new UserBusinessService();
            $userList = $userService->listUsers();

            // get job postings from database
            $jobService = new JobPostBusinessService();
            $jobData = $jobService->getJobPosts();

            // create new data array with list of users, job posts, and the selected tool
            $data = [
                "userList" => $userList,
                "toolId" => $toolId,
                "jobData" => $jobData,
                "message" => $message
            ];

            // return view with users list
            return view("admin")->with($data);
        } catch (Exception $e) {
            LarabarLogger::error("AdminController::index error: " .
                $e->getMessage());
            return view("error");
        }
    }

    /**
     * Suspend a user
     * @param $userId
     * @return AdminController|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function suspend($userId)
    {
        LarabarLogger::info("-> AdminController::suspend");

        // try to record suspension in database
        try {

            // call suspend user method from service
            $service = new SuspendUserBusinessService();
            $user = new UserModel($userId);
            $service->suspend($user);

            // run index to generate updated user list
            return $this->index("User [$userId] suspended.");
        } catch (Exception $e) {
            LarabarLogger::error("AdminController::suspend error: " .
                $e->getMessage());
            return view("error");
        }
    }

    /**
     * Reactivate a user
     * @param $userId
     * @return AdminController
     * @throws \Exception
     */
    public function reactivate($userId)
    {
        LarabarLogger::info("-> AdminController::reactivate");
        try {

            // call reactive user method from service
            $service = new SuspendUserBusinessService();
            $user = new UserModel($userId);
            $service->reactivate($user);

            // run index to generate updated user list. Pass message.
            return $this->index(-1, "User [$userId] suspended.");
        } catch (Exception $e) {
            LarabarLogger::error("AdminController::reactivate error: " .
                $e->getMessage());
            return view("error");
        }
    }

    /**
     * Delete a user
     * @param $userId
     * @return mixed
     */
    public function deleteUser($userId)
    {
        LarabarLogger::info("-> AdminController::deleteUser");
        try {
            // create a user business service
            $service = new UserBusinessService();

            // call reactive user method
            $service->deleteUser($userId);

            // run index to generate updated user list. Pass deletion message
            return $this->index(-1, "User [$userId] deleted.");
        } catch (Exception $e) {
            LarabarLogger::error("AdminController::deleteUser error: " .
                $e->getMessage());
            return view("error");
        }
    }

    /**
     * Render job post editing form
     * @param $id
     * @return $this
     */
    public function updateJobPost($id)
    {
        LarabarLogger::info("-> AdminController::updateJobPost");
        try {

            // load job from database using id
            $jobSvc = new JobPostBusinessService();
            $jobPost = $jobSvc->getJobPosts($id, true)[0];

            // return update view with job post
            return view('updateInfo')->with(['post' => $jobPost]);
        } catch (Exception $e) {
            LarabarLogger::error("AdminController::updateJobPost error: " .
                $e->getMessage());
            return view("error");
        }
    }

    /**
     * Save updated job post data
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateJobPostData(Request $request)
    {
        LarabarLogger::info("-> AdminController::updateJobPostData");
        try {
            // validate job post rules were kept
            $this->validateJobPost($request);

            // call update method from service
            $jobSvc = new JobPostBusinessService();
            $jobSvc->updateJobPost($request->input());

            // execute controller index action to render view
            return redirect()->action('AdminController@index');
        } catch (Exception $e) {
            LarabarLogger::error("AdminController::updateJobPostData error: " .
                $e->getMessage());
            return view("error");
        }
    }

    /**
     * Delete a Job Post
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteJobPost($id)
    {
        LarabarLogger::info("-> AdminController::deleteJobPost");
        try {
            // call JobPostBusinessService delete method
            $jobSvc = new JobPostBusinessService();
            $jobSvc->deleteJobPost($id);

            // execute controller index action to render view
            return redirect()->action('AdminController@index');
        } catch (Exception $e) {
            LarabarLogger::error("AdminController::deleteJobPost error: " .
                $e->getMessage());
            return view("error");
        }
    }

    /**
     * Create a new Job Post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addJobPost(Request $request)
    {
        LarabarLogger::info("-> AdminController::addJobPost");
        try {

            // validate input follows rules
            $this->validateJobPost($request);

            // JobPostBusinessService create method to save job post in database
            $jobSvc = new JobPostBusinessService();
            $jobSvc->createJobPost($request->input());

            // execute controller index action to render view
            return redirect()->action('AdminController@index');
        } catch (Exception $e) {
            LarabarLogger::error("AdminController::addJobPost error: " .
                $e->getMessage());
            return view("error");
        }
    }

    /**
     * Validate request input follows rules
     * @param Request $request
     */
    public function validateJobPost(Request $request)
    {
        LarabarLogger::info("-> AdminController::validateJobPost");

        // Define rules
        $rules = [
            'title' => 'Required|Between:4,20',
            'author' => 'Required|Between:5,50',
            'location' => 'Required|Between:2,40',
            'description' => 'Required|Between:10,100',
            'requirements' => 'Required|Between:10,100',
            'salary' => 'Required|Numeric'
        ];

        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            LarabarLogger::warning("AdminController::validateJobPost validation exception");
            throw $ve;
        }
    }

}
