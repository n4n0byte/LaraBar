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

    function update(){
        $profile = new UserProfileDataAccessService();
    }
}
