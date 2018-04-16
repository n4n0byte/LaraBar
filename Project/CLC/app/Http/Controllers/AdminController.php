<?php

namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Services\Business\JobPostBusinessService;
use App\Services\Business\SuspendUserBusinessService;
use App\Services\Business\UserBusinessService;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index($toolId = -1)
    {
        // generate users list
        $temp = new UserModel(0);
        $userService = new UserBusinessService($temp);
        $userList = $userService->listUsers();
        $jobData = new JobPostBusinessService();

        $data = [
            "userList" => $userList,
            "toolId" => $toolId,
            "jobData" => $jobData->getJobPosts()
        ];
        // return view with users list
        return view("admin")->with($data);
    }

    public function suspend($userId)
    {
        // create suspended_user business service
        $service = new SuspendUserBusinessService();

        // call suspend user method
        $user = new UserModel($userId);
        $service->suspend($user);

        // run index to generate updated user list
        return $this->index("User [$userId] suspended.");
    }

    public function reactivate($userId)
    {
        // create suspended_user business service
        $service = new SuspendUserBusinessService();

        // call reactive user method
        $user = new UserModel($userId);
        $service->reactivate($user);

        // run index to generate updated user list
        return $this->index("User [$userId] suspended.");
    }

    public function deleteUser($userId)
    {
        // create a user business service
        $user = new UserModel($userId);
        $service = new UserBusinessService($user);

        // call reactive user method
        $service->deleteUser();

        // run index to generate updated user list
        $message = "User $userId deleted";
        return $this->index("User [$userId] suspended.")->with("message", $message);
    }

    public function updateJobPost($id)
    {
        $jobSvc = new JobPostBusinessService();
        $jobPost = $jobSvc->getJobPosts($id, true)[0];
        return view('updateInfo')->with(['post' => $jobPost]);

    }

    public function updateJobPostData(Request $request)
    {
        $this->validateJobPost($request);
        $jobSvc = new JobPostBusinessService();

        $jobSvc->updateJobPost($request->get("id"), $request->get("title"), $request->get("location"),
            $request->get("description"), $request->get("requirements"), (int)$request->get("salary"));

        return redirect()->action('AdminController@index');
    }

    public function deleteJobPost($id)
    {

        $jobSvc = new JobPostBusinessService();
        $jobSvc->deleteJobPost($id);
        return redirect()->action('AdminController@index');
    }

    public function addJobPost(Request $request)
    {
        $this->validateJobPost($request);
        $jobSvc = new JobPostBusinessService();
        $jobSvc->createJobPost($request->get("title"), $request->get("location"),
            $request->get("description"), $request->get("requirements"), $request->get("salary"));

        return redirect()->action('AdminController@index');
    }

    private function isAdmin()
    {
        // TODO check if user has admin access using session
        return TRUE;
    }

    public function validateJobPost(Request $request)
    {

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
            throw $ve;
        }
    }

}
