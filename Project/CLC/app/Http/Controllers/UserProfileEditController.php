<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Data\UserProfileDataAccessService;

class UserProfileEditController extends Controller
{
    function showEditor(){
        $profile = new UserProfileDataAccessService();
        return view('edit_profile')->with(['data' => $profile->read()]);
    }

    function update(Request $request){
        $profileSvc = new UserProfileDataAccessService();

        $inputEmploymentHistory= $request->input('employmentHistory');
        $inputLocation = $request->input('location');
        $inputEducation = $request->input('education');
        $inputBio = $request->input('bio');
        $profileSvc->update($inputEmploymentHistory,$inputLocation,$inputEducation,$inputBio);
        return view('profile')->with(['data' => $profileSvc->read()]);

    }
}
