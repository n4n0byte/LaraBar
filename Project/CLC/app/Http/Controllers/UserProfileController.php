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
use App\Services\Business\EducationBusinessService;
use App\Services\Business\EmploymentHistoryBusinessService;
use App\Services\Business\SkillsBusinessService;
use App\Services\Business\UserProfileBusinessService;
use Illuminate\Http\Request;
use App\Services\Data\UserProfileDataAccessService;

class UserProfileController extends Controller
{

    private static $types = ['employmentHistory','education','skill'];

    /**
     * @param $type
     * @param $name
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function viewAdd($type,$name){

        $result = array_search($type,self::$types);

        $data = ['type' => $type, 'name' => $name];

        return $result === false ? redirect()->action('ProfileController@index') :
            view("add")->with($data);

    }

    public function add(Request $request){


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
    function showEditor($category)
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
        return view('edit_profile')->with(['data' => $data]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    function update(Request $request)
    {
        $profileSvc = new UserProfileDataAccessService();

        $inputEmploymentHistory = $request->input('employmentHistory');
        $inputLocation = $request->input('location');
        $inputEducation = $request->input('education');
        $inputBio = $request->input('bio');
        $profileSvc->update($inputEmploymentHistory, $inputLocation, $inputEducation, $inputBio);
        return view('profile')->with(['data' => $profileSvc->read()]);

    }

}