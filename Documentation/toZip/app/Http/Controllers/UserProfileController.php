<?php
/*
version 1.0

Ali
CST-256
January 31, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

namespace App\Http\Controllers;

use App\Model\EducationModel;
use App\Model\EmploymentHistoryModel;
use App\Model\SkillsModel;
use App\Model\UserModel;
use App\Model\UserProfileModel;
use App\Services\Business\EducationBusinessService;
use App\Services\Business\EmploymentHistoryBusinessService;
use App\Services\Business\SkillsBusinessService;
use App\Services\Business\UserBusinessService;
use App\Services\Business\UserProfileBusinessService;
use Illuminate\Http\Request;

class UserProfileController extends Controller {

    private static $types = ['employmentHistory', 'education', 'skill'];
    private $eduService, $empService, $skillService, $userProfileService, $userService;


    function __construct() {
        $this->eduService = new EducationBusinessService();
        $this->empService = new EmploymentHistoryBusinessService();
        $this->skillService = new SkillsBusinessService();
        $this->userProfileService = new UserProfileBusinessService();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePersonalInfo(Request $request) {

        $user = session('user');
        $this->userService = new UserBusinessService($user);
        $model = new UserModel(
            $user->getId(), $request->get('email'), $request->get('password'),
            $request->get('firstName'), $request->get('lastName')
        );

        $this->userService->updateUserInfo($model);

        return redirect()->action("UserProfileController@show");
    }

    /**
     * @param $type
     * @param $name
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function viewAdd($type, $name) {

        $result = array_search($type, self::$types);

        $data = ['type' => $type, 'name' => $name];

        return $result === false ? redirect()->action('UserProfileController@show') :
            view("add")->with($data);

    }

    public function add(Request $request) {
        return redirect()->action("ProfileController@index");
    }


    /**
     * @return $this
     */
    function show() {
        /* @var $user UserModel */
        $user = session()->get("user");

        // get profile
        // general
        $profileService = new UserProfileBusinessService();
        $profile = $profileService->getProfileData();

        // education
        $eduService = new EducationBusinessService();
        $education = $eduService->getEducation($user->getId());

        // employment history
        $empService = new EmploymentHistoryBusinessService();
        $employment = $empService->getEmploymentHistory($user->getId());

        $skillsSvc = new SkillsBusinessService();
        $skills = $skillsSvc->getSkill($user->getId());

        // put into $data and send to view
        $data = [
            'userProfile' => $profile['userProfile'],
            'user' => $user,
            'education' => $education,
            'employment' => $employment,
            'skills' => $skills
        ];

        return view('profile')->with($data);
    }

    /**
     * @param Request $request
     */
    function updateBiography(Request $request) {

        $bio = $request->get('biography');
        $location = $this->userProfileService->getProfileData()['userProfile']->getLocation();

        $model = new UserProfileModel("", $bio, $location);
        $this->userProfileService->updateUserProfile($model);

        return redirect()->action('UserProfileController@show');

    }

    /**
     * @param Request $request
     */
    function updateLocation(Request $request) {

        $location = $request->get('location');
        $bio = $this->userProfileService->getProfileData()['userProfile']->getBio();

        $model = new UserProfileModel("", $bio, $location);
        $this->userProfileService->updateUserProfile($model);

        return redirect()->action('UserProfileController@show');

    }

    /**
     * @param $category
     * @return $this
     */
    function showEditor($category, $id) {
        /* @var $user UserModel */
        $user = session('user');

        // get profile
        // general
        $model = null;
        $view = null;

        switch ($category) {
            case "education":
                $model = $this->eduService->getEducation((int)$id, true)[0];
                $category = "education";
                break;
            case "employment":
                $model = $this->empService->getEmploymentHistory((int)$id, true)[0];
                $category = "employment";
                break;
            case "skills":
                $model = $this->skillService->getSkill((int)$id, true)[0];
                $category = "skills";
                break;
            case "personal":
                $model = $user;
                $category = "personal";
                break;
            case "location":
                //get profile model
                $model = $this->userProfileService->getProfileData();
                $model = $model['userProfile'];
                $category = "location";
                break;
            case "biography":
                //get profile model
                $model = $this->userProfileService->getProfileData();
                $model = $model['userProfile'];
                $category = "biography";
                break;
        }

        $data = [
            'model' => $model,
            'category' => $category
        ];

        return view('edit_profile')->with($data);
    }

    function editMember() {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function updateProfile(Request $request) {

        // get inputs
        $inputLocation = $request->input('location');
        $inputBio = $request->input('bio');
        /* @var $user UserModel */
        $user = session('user');

        // create model
        $model = new UserProfileModel();
        $model->setBio($inputBio);
        $model->setLocation($inputLocation);
        $model->setUid($user->getId());

        // commit changes
        $profileSvc = new UserProfileBusinessService();
        $profileSvc->updateUserProfile($model);
        return redirect()->action("UserProfileController@show");
    }

    function updateEducation(Request $request) {
        // get inputs
        $inputInstitution = $request->input('institution');
        $inputLevel = $request->input('level');
        $inputDegree = $request->input('degree');
        $inputId = $request->input('post-id');

        /* @var $user UserModel */
        $user = session('user');

        // create model
        /* $model = */
        $model = new EducationModel($inputId, $user->getId(), $inputInstitution, $inputLevel, $inputDegree);

        // commit changes
        $profileSvc = new EducationBusinessService();
        $profileSvc->updateEducation($model);
        return redirect()->action("UserProfileController@show");
    }

    function createEducation(Request $request) {
        // get inputs
        $inputInstitution = $request->input('institution');
        $inputLevel = $request->input('level');
        $inputDegree = $request->input('degree');

        /* @var $user UserModel */
        $user = session('user');

        // create model
        /* $model = */
        $model = new EducationModel(-1, $user->getId(), $inputInstitution, $inputLevel, $inputDegree);

        // commit changes
        $profileSvc = new EducationBusinessService();
        $profileSvc->updateEducation($model);
        return redirect()->action("UserProfileController@show");
    }

    function updateEmployment(Request $request) {
        // get inputs
        $inputEmployer = $request->input('employer');
        $inputPosition = $request->input('position');
        $inputDuration = $request->input('duration');
        $inputId = $request->input('post-id');
        /* @var $user UserModel */
        $user = session('user');

        // create model
        $model = new EmploymentHistoryModel($inputId, $user->getId(), $inputEmployer, $inputPosition, $inputDuration);

        // commit changes
        $profileSvc = new EmploymentHistoryBusinessService();
        $profileSvc->updateEmploymentHistory($model);
        return redirect()->action("UserProfileController@show");
    }

    function createEmployment(Request $request) {
        // get inputs
        $inputEmployer = $request->input('employer');
        $inputPosition = $request->input('position');
        $inputDuration = $request->input('duration');
        /* @var $user UserModel */
        $user = session('user');

        // create model
        $model = new EmploymentHistoryModel(-1, $user->getId(), $inputEmployer, $inputPosition, $inputDuration);

        // commit changes
        $profileSvc = new EmploymentHistoryBusinessService();
        $profileSvc->updateEmploymentHistory($model);
        return redirect()->action("UserProfileController@show");
    }

    function updateSkills(Request $request) {
        // get inputs
        $inputTitle = $request->input('title');
        $inputDescription = $request->input('description');
        $inputId = $request->input('post-id');
        /* @var $user UserModel */
        $user = session('user');

        // create model
        $model = new SkillsModel($inputId, $user->getId(), $inputTitle, $inputDescription);

        // commit changes
        $profileSvc = new SkillsBusinessService();
        $profileSvc->updateSkill($model);
        return redirect()->action("UserProfileController@show");
    }

    function createSkills(Request $request) {
        // get inputs
        $inputTitle = $request->input('title');
        $inputDescription = $request->input('description');
        /* @var $user UserModel */
        $user = session('user');

        // create model
        $model = new SkillsModel(-1, $user->getId(), $inputTitle, $inputDescription);

        // commit changes
        $profileSvc = new SkillsBusinessService();
        $profileSvc->insertSkill($model);
        return redirect()->action("UserProfileController@show");
    }

    /**
     * @param $category
     * @return $this
     */
    function addEditor($category) {
        /* @var $user UserModel */
        $user = session('user');

        // get profile
        // general
        $profileService = new UserProfileBusinessService();
        $profile = $profileService->getProfileData();

        // education for current user
        $eduService = new EducationBusinessService();


        // employment history for current user
        $empService = new EmploymentHistoryBusinessService();

        $data = [
            'user' => $profile["user"],
            'userProfile' => $profile["userProfile"],
            'category' => $category,
            'education' => $eduService->getEducation(),
            'employment' => $empService->getEmploymentHistory()
        ];
        return view('add_profile')->with(['data' => $data]);
    }

    /**
     * @param $category
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function delete($category, $id) {
        /* @var $user UserModel */
        $user = session('user');
        // get profile
        // general
        $message = null;
        switch ($category) {
            case "education":
                $this->eduService->deleteEducation((int)$id);
                $message = "Education record $id removed";
                break;
            case "employment":
                $this->empService->removeEmploymentHistory((int)$id);
                $message = "Employment record $id removed";
                break;
            case "skills":
                $this->skillService->deleteSkill((int)$id);
                $message = "Skill record $id removed";
                break;
            default:
                $message = "Nothing has changed";
        }
        return redirect()->action("UserProfileController@show")->with(['confirmation' => $message]);
    }

    /**
     * @param Request $request
     */
    function validateProfile(Request $request) {
        // Define rules
        $rules = [
            'bio' => 'Between:0,50|',
            'location' => 'Between:0,50'
        ];

        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            throw $ve;
        }
    }

    /**
     * @param Request $request
     */
    function validateEmployment(Request $request) {
        // Define rules
        $rules = [
            'employer' => 'Required|Between:1,50',
            'position' => 'Required|Between:1,50',
            'duration' => 'Required|Between:0,50'
        ];

        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            throw $ve;
        }
    }

    /**
     * @param Request $request
     */
    function validateEducation(Request $request) {
        // Define rules
        $rules = [
            'institution' => 'Required|Between:1,50',
            'level' => 'Required|Between:1,50',
            'degree' => 'Required|Between:0,50'
        ];


        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            throw $ve;
        }
    }

    /**
     * @param Request $request
     */
    function validateSkills(Request $request) {
        // Define rules
        $rules = [
            'title' => 'Required|Between:1,50',
            'description' => 'Required|Between:1,50'
        ];

        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            throw $ve;
        }
    }
}