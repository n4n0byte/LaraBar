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
use App\Services\Utility\ILogger;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{

    private static $types = ['employmentHistory', 'education', 'skill'];
    private $eduService, $empService, $skillService, $userProfileService, $userService;
    private $logger;

    function __construct(ILogger $logger)
    {
        $this->eduService = new EducationBusinessService();
        $this->empService = new EmploymentHistoryBusinessService();
        $this->skillService = new SkillsBusinessService();
        $this->userProfileService = new UserProfileBusinessService();
        $this->logger = $logger;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function updatePersonalInfo(Request $request)
    {
        $this->logger->info("UserProfileController::updatePersonalInfo");
        try {
            $data = $request->input();
            $data["id"] = session("user")->getId();
            $this->userService = new UserBusinessService();

            $this->userService->updateUserInfo($data);

            return redirect()->action("UserProfileController@show");
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param $type
     * @param $name
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function viewAdd($type, $name)
    {
        $this->logger->info("UserProfileController::viewAdd");

        try {
            $result = array_search($type, self::$types);

            $data = ['type' => $type, 'name' => $name];

            return $result === false ? redirect()->action('UserProfileController@show') :
                view("add")->with($data);
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    public function add(Request $request)
    {
        $this->logger->info("UserProfileController::add");

        return redirect()->action("ProfileController@index");
    }


    /**
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function show()
    {
        $this->logger->info("UserProfileController::show");

        try {
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
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function updateBiography(Request $request)
    {
        $this->logger->info("UserProfileController::updateBiography");

        try {
            $this->validateProfile($request);
            $bio = $request->get('biography');
            $location = $this->userProfileService->getProfileData()['userProfile']->getLocation();

            $model = new UserProfileModel("", $bio, $location);
            $this->userProfileService->updateUserProfile($model);

            return redirect()->action('UserProfileController@show');
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function updateLocation(Request $request)
    {
        $this->logger->info("UserProfileController::updateLocation");

        try {
            $this->validateProfile($request);
            $location = $request->get('location');
            /* @var $this ->userProfileService->getProfileData()['userProfile'] UserProfileModel */
            $bio = $this->userProfileService->getProfileData()['userProfile']->getBio();

            $model = new UserProfileModel("", $bio, $location);
            $this->userProfileService->updateUserProfile($model);

            return redirect()->action('UserProfileController@show');
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param $category
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function showEditor($category, $id)
    {
        $this->logger->info("UserProfileController::showEditor");

        try {
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
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function updateProfile(Request $request)
    {
        $this->logger->info("UserProfileController::updateProfile");

        try {
            $this->validateProfile($request);
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
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function updateEducation(Request $request)
    {
        $this->logger->info("UserProfileController::updateEducation");

        try {
            $this->validateEducation($request);
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
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function createEducation(Request $request)
    {
        $this->logger->info("UserProfileController::createEducation");

        try {
            $this->validateEducation($request);
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
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function updateEmployment(Request $request)
    {
        $this->logger->info("UserProfileController::updateEmployment");

        try {
            $this->validateEmployment($request);
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
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function createEmployment(Request $request)
    {
        $this->logger->info("UserProfileController::createEmployment");

        try {
            $this->validateEmployment($request);
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
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function updateSkills(Request $request)
    {
        $this->logger->info("UserProfileController::updateSkills");

        try {
            $this->validateSkills($request);
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
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function createSkills(Request $request)
    {
        $this->logger->info("UserProfileController::createSkills");

        try {
            $this->validateSkills($request);
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
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param $category
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function addEditor($category)
    {
        $this->logger->info("UserProfileController::addEditor");

        try {

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
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("UserProfileController error: " . $e);
            return view("error");
        }
    }

    /**
     * @param $category
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function delete($category, $id)
    {
        $this->logger->info("UserProfileController::delete");

        try {
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
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    function validateProfile(Request $request)
    {
        $this->logger->info("UserProfileController::validateProfile");

        // Define rules
        $rules = [
            'biography' => 'Between:5,50|',
            'location' => 'Between:5,50'
        ];

        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        }
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    function validateEmployment(Request $request)
    {
        $this->logger->info("UserProfileController::validateEmployment");

        // Define rules
        $rules = [
            'employer' => 'Required|Between:1,50',
            'position' => 'Required|Between:1,50',
            'duration' => 'Required|Between:1,50'
        ];

        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        }
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    function validateEducation(Request $request)
    {
        $this->logger->info("UserProfileController::validateEducation");

        // Define rules
        $rules = [
            'institution' => 'Required|Between:1,50',
            'level' => 'Required|Between:1,50',
            'degree' => 'Required|Between:1,50'
        ];


        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        }
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    function validateSkills(Request $request)
    {
        $this->logger->info("UserProfileController::validateSkills");

        // Define rules
        $rules = [
            'title' => 'Required|Between:1,50',
            'description' => 'Required|Between:1,50'
        ];

        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        }
    }
}