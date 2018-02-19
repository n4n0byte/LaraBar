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

use App\Model\UserModel;
use App\Services\Business\UserBusinessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Helper\Table;
use \App\Services\Data\UserProfileDataAccessService;

class UserProfileController extends Controller
{

    function show()
    {
        $profile = new UserProfileDataAccessService();
        $result = view('profile')->with(['data' => $profile->read()]);
        return $result;
    }

    function showEditor($category)
    {
        $profile = new UserProfileDataAccessService();
        $models = $profile->read();
        $data = [
            'user' => $models["user"],
            'userProfile' => $models["userProfile"],
            'category' => $category

        ];
        /*var_dump($data);
        exit();*/
        return view('edit_profile')->with(['data' => $data]);
    }

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