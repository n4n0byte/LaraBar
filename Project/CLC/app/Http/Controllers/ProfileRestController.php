<?php

namespace App\Http\Controllers;

use App\Model\DTO;
use App\Services\Business\EducationBusinessService;
use App\Services\Business\EmploymentHistoryBusinessService;
use App\Services\Business\SkillsBusinessService;
use App\Services\Business\UserProfileBusinessService;

/**
 * Provides a rest service for accessing user
 * profile information in the form of a DTO
 * Class ProfileRestController
 * @package App\Http\Controllers
 */
class ProfileRestController extends Controller
{

    /**
     * @return DTO
     */
    public function index()
    {
        return new DTO(400, "Input Error");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dto = null;

        // try to access all Profile Related services
        // to convert
        try {

            // instantiate all profile related business services and fill an array
            // with the data returned by their find by id
            $userSvc = new UserProfileBusinessService();
            $profile = $userSvc->getProfileById($id);

            $employmentHistorySvc = new EmploymentHistoryBusinessService();
            $employmentHistory = $employmentHistorySvc->getEmploymentHistory($id);

            $skillsSvc = new SkillsBusinessService();
            $skills = $skillsSvc->getSkill($id);

            $educationSvc = new EducationBusinessService();
            $education = $educationSvc->getEducation($id);

            $resultArr = [$profile, $employmentHistory, $skills, $education];


            $statusCode = 200;
            $message = "success";

            // check if user exists
            if ($profile == null) {
                $statusCode = 404;
                $message = "No profile found";
                $resultArr = [];
            }

        } // set error status code
        catch (\Exception $e) {
            $statusCode = 500;
            $message = "It broke";
            $resultArr = [];
        } finally {
            return json_encode(new DTO($statusCode, $message, $resultArr), JSON_PRETTY_PRINT);
        }

    }

}
