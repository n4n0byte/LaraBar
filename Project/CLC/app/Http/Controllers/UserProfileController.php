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

use App\Services\Business\EducationBusinessService;
use App\Services\Business\EmploymentHistoryBusinessService;
use App\Services\Business\UserProfileBusinessService;
use Illuminate\Http\Request;
use App\Services\Data\UserProfileDataAccessService;

class UserProfileController extends Controller
{

    /**
     * @return $this
     */
    function show()
    {
        // get profile
        // general
        $profileService = new UserProfileBusinessService();
        $profile = $profileService->getProfileData();

        // employment history
        $empService = new EmploymentHistoryBusinessService();
        $employment = $empService->getEmploymentHistory();

        // education
        $eduService = new EducationBusinessService();
        $education = $eduService->getEducation();

        // put into $data and send to view
        $data = [
            'profile' => $profile,
            'education' => $education,
            'employment' => $employment
        ];
        $result = view('profile')->with($data);
        return $result;
    }

    /**
     * @param $category
     * @return $this
     */
    function showEditor($category)
    {
        $profile = new UserProfileDataAccessService();
        $models = $profile->read();
        $data = [
            'user' => $models["user"],
            'userProfile' => $models["userProfile"],
            'category' => $category

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