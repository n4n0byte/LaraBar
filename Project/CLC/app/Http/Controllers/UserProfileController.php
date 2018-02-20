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
use App\Services\Business\UserProfileBusinessService;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{

    private static $types = ['employmentHistory', 'education', 'skill'];
    private $eduService, $empService, $skillService;

    function __construct()
    {
        $this->eduService = new EducationBusinessService();
        $this->empService = new EmploymentHistoryBusinessService();
        $this->skillService = new SkillsBusinessService();
    }

    /**
     * @param $type
     * @param $name
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function viewAdd($type, $name)
    {

        $result = array_search($type, self::$types);

        $data = ['type' => $type, 'name' => $name];

        return $result === false ? redirect()->action('UserProfileController@show') :
            view("add")->with($data);

    }

    public function add(Request $request)
    {


        return redirect()->action("ProfileController@index");
    }


    /**
     * @return $this
     */
    function show()
    {
        // get profile
        // general
        $profileService = new UserProfileBusinessService();
        $profile = $profileService->getProfileData();

        // education
        $eduService = new EducationBusinessService();
        $education = $eduService->getEducation();

        // employment history
        $empService = new EmploymentHistoryBusinessService();
        $employment = $empService->getEmploymentHistory();

        $skillsSvc = new SkillsBusinessService();
        $skills = $skillsSvc->getSkill();

        // put into $data and send to view
        $data = [
            'userProfile' => $profile['userProfile'],
            'user' => $profile['user'],
            'education' => $education,
            'employment' => $employment,
            'skills' => $skills
        ];

        return view('profile')->with($data);
    }

    /**
     * @param $category
     * @return $this
     */
    function showEditor($category, $id)
    {
        /* @var $user UserModel */
        $user = session('user');

        // get profile
        // general
        $model = null;
        $view = null;

        switch ($category) {
            case "education":
                $model = $this->eduService->getEducation((int)$id, true);
                $category = "education";
                break;
            case "employment":
                $model = $this->empService->getEmploymentHistory((int)$id,true);
                $category = "employment";
                break;
            case "skills":
                $model = $this->skillService->getSkill((int)$id,true);
                $category = "skills";
                break;
        }

        $data = [
            'model' => $model[0],
            'category' => $category
        ];

            return view('edit_profile')->with($data);
    }

    function editMember()
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function updateProfile(Request $request)
    {

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

    function updateEducation(Request $request)
    {
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

    function createEducation(Request $request)
    {
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

    function updateEmployment(Request $request)
    {
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

    function createEmployment(Request $request)
    {
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

    function updateSkills(Request $request)
    {
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

    function createSkills(Request $request)
    {
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
    function addEditor($category)
    {
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

}