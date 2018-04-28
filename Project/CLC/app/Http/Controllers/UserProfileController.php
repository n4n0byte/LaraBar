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
     * update user information
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function updatePersonalInfo(Request $request)
    {
        $this->logger->info("UserProfileController::updatePersonalInfo");
        try {

            // get request input and user id
            $data = $request->input();
            $data["id"] = session("user")->getId();

            // create a service to store updated information in database
            $this->userService = new UserBusinessService();
            $this->userService->updateUserInfo($data);

            // redirect to the page render method
            return redirect()->action("UserProfileController@show");
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("UserProfileController::updatePersonalInfo error");
            return view("error");
        }
    }

    /**
     * render page for adding user profile elements
     * @param $type
     * @param $name
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function viewAdd($type, $name)
    {
        $this->logger->info("UserProfileController::viewAdd");
        try {

            // check that user selected employment history, skill, or education
            $result = array_search($type, self::$types);
            $data = ['type' => $type, 'name' => $name];

            // If an invalid type is selected, return the show view.
            // Else, render the add view with the type information (specifies which form to load).
            return $result === false ? redirect()->action('UserProfileController@show') :
                view("add")->with($data);
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("UserProfileController::viewAdd error");
            return view("error");
        }
    }

    /**
     * Render a user's profile page
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function show()
    {
        $this->logger->info("UserProfileController::show");
        try {

            // get profile parts
            /* @var $user UserModel */
            $user = session()->get("user");

            // get general information
            $profileService = new UserProfileBusinessService();
            $profile = $profileService->getProfileData($user->getId());

            // get education
            $eduService = new EducationBusinessService();
            $education = $eduService->getEducation($user->getId());

            // get employment history
            $empService = new EmploymentHistoryBusinessService();
            $employment = $empService->getEmploymentHistory($user->getId());

            // get skills
            $skillsSvc = new SkillsBusinessService();
            $skills = $skillsSvc->getSkill($user->getId());

            // put all profile parts into array and pass to view
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
            $this->logger->error("UserProfileController::show error");
            return view("error");
        }
    }

    /**
     * Update a user's biography
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function updateBiography(Request $request)
    {
        $this->logger->info("UserProfileController::updateBiography");
        try {

            // check that input follows validation rules
            $this->validateProfile($request);

            // get bio from request input
            $bio = $request->get('biography');

            // get location from profile service
            $location = $this->userProfileService->getProfileData(session("user")->getId())['userProfile']->getLocation();

            // create a user profile model with bio and location
            $model = new UserProfileModel("", $bio, $location);

            // update user bio and redirect user to profile page
            $this->userProfileService->updateUserProfile($model);
            return redirect()->action('UserProfileController@show');
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("UserProfileController::updateBiography error");
            return view("error");
        }
    }

    /**
     * Update user's location
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function updateLocation(Request $request)
    {
        $this->logger->info("UserProfileController::updateLocation");
        try {

            // validate request input follows rules
            $this->validateProfile($request);

            // get location from request input
            $location = $request->get('location');

            // get current bio and create an update profile model
            /* @var $this ->userProfileService->getProfileData(session("UID"))['userProfile'] UserProfileModel */
            $bio = $this->userProfileService->getProfileData(session("UID"))['userProfile']->getBio();
            $model = new UserProfileModel("", $bio, $location);

            // update user profile
            $this->userProfileService->updateUserProfile($model);

            // redirect to user profile page
            return redirect()->action('UserProfileController@show');
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("UserProfileController::updateLocation error");
            return view("error");
        }
    }

    /**
     * Render appropriate editor for profile element (employment, skill, education) for update.
     * @param $category
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function showEditor($category, $id)
    {
        $this->logger->info("UserProfileController::showEditor");
        try {

            // get user from session
            /* @var $user UserModel */
            $user = session('user');

            // declare model and view variables
            $model = null;
            $view = null;

            // switch for selecting category (education, employment, skill, personal, location, or biography) to add to.
            switch ($category) {

                // education, employment, skill component
                case "education":

                    // define a new model for category (education) by retrieving existing
                    // model from database using post id
                    $model = $this->eduService->getEducation((int)$id, true)[0];
                    break;
                case "employment":
                    $model = $this->empService->getEmploymentHistory((int)$id, true)[0];
                    break;
                case "skills":
                    $model = $this->skillService->getSkill((int)$id, true)[0];
                    break;
                case "personal":
                    $model = $user;
                    break;

                // general profile information
                case "location":

                    //get profile model
                    $model = $this->userProfileService->getProfileData(session("UID"));
                    $model = $model['userProfile'];
                    $category = "location";
                    break;
                case "biography":

                    //get profile model
                    $model = $this->userProfileService->getProfileData(session("UID"));
                    $model = $model['userProfile'];
                    $category = "biography";
                    break;
            }

            // pass category and model to view (category determines which editor to render)
            $data = [
                'model' => $model,
                'category' => $category
            ];
            return view('edit_profile')->with($data);
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("UserProfileController::showEditor error");
            return view("error");
        }
    }

    /**
     * Update user profile
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function updateProfile(Request $request)
    {
        $this->logger->info("UserProfileController::updateProfile");

        try {
            $this->validateProfile($request);

            // get inputs from request
            $inputLocation = $request->input('location');
            $inputBio = $request->input('bio');

            // get user from session
            /* @var $user UserModel */
            $user = session('user');

            // create model from input values
            $model = new UserProfileModel();
            $model->setBio($inputBio);
            $model->setLocation($inputLocation);
            $model->setUid($user->getId());

            // commit changes to database
            $profileSvc = new UserProfileBusinessService();
            $profileSvc->updateUserProfile($model);

            // redirect to user profile page
            return redirect()->action("UserProfileController@show");
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("UserProfileController::updateProfile error");
            return view("error");
        }
    }

    /**
     * Update a user education profile item
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function updateEducation(Request $request)
    {
        $this->logger->info("UserProfileController::updateEducation");
        try {

            // validate request input follows rules
            $this->validateEducation($request);

            // get inputs from request
            $inputInstitution = $request->input('institution');
            $inputLevel = $request->input('level');
            $inputDegree = $request->input('degree');
            $inputId = $request->input('post-id');

            // get user from session
            /* @var $user UserModel */
            $user = session('user');

            // create model from inputs
            /* $model = */
            $model = new EducationModel($inputId, $user->getId(), $inputInstitution, $inputLevel, $inputDegree);

            // commit changes to database
            $profileSvc = new EducationBusinessService();
            $profileSvc->updateEducation($model);
            return redirect()->action("UserProfileController@show");
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("UserProfileController::updateEducation error");
            return view("error");
        }
    }

    /**
     * Create a new education record for a user's profile
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function createEducation(Request $request)
    {
        $this->logger->info("UserProfileController::createEducation");
        try {

            // validate request input follows rules
            $this->validateEducation($request);

            // get inputs
            $inputInstitution = $request->input('institution');
            $inputLevel = $request->input('level');
            $inputDegree = $request->input('degree');

            // get user from session
            /* @var $user UserModel */
            $user = session('user');

            // create model (set id to -1 to indicate a new record to insert)
            $model = new EducationModel(-1, $user->getId(), $inputInstitution, $inputLevel, $inputDegree);

            // commit changes
            $profileSvc = new EducationBusinessService();
            $profileSvc->updateEducation($model);

            // render user profile page
            return redirect()->action("UserProfileController@show");
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("UserProfileController::createEducation error");
            return view("error");
        }
    }

    /**
     * Update a employment history record
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function updateEmployment(Request $request)
    {
        $this->logger->info("UserProfileController::updateEmployment");
        try {

            // validate request input follows validation rules
            $this->validateEmployment($request);

            // get inputs from request
            $inputEmployer = $request->input('employer');
            $inputPosition = $request->input('position');
            $inputDuration = $request->input('duration');
            $inputId = $request->input('post-id');

            // get user from session
            /* @var $user UserModel */
            $user = session('user');

            // create employment history model
            $model = new EmploymentHistoryModel($inputId, $user->getId(), $inputEmployer, $inputPosition, $inputDuration);

            // commit changes
            $profileSvc = new EmploymentHistoryBusinessService();
            $profileSvc->updateEmploymentHistory($model);

            // redirect to user profile page
            return redirect()->action("UserProfileController@show");
        } catch (ValidationException $ve) {
            $this->logger->warning("UserProfileController validation exception");
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("UserProfileController::updateEmployment error");
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
            $this->logger->error("UserProfileController::createEmployment error");
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
            $this->logger->error("UserProfileController::updateSkills error");
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
            $this->logger->error("UserProfileController::createSkills error");
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
            $profile = $profileService->getProfileData(session("UID"));

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