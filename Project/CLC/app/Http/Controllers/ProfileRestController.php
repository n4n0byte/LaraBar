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

            // employment history
            $employmentHistorySvc = new EmploymentHistoryBusinessService();
            $employmentHistory = $employmentHistorySvc->getEmploymentHistory($id);

            // skills
            $skillsSvc = new SkillsBusinessService();
            $skills = $skillsSvc->getSkill($id);

            // education
            $educationSvc = new EducationBusinessService();
            $education = $educationSvc->getEducation($id);

            // Build result array. If a profile is not found, return empty.
            $resultArr = $profile != null ? [$profile, $employmentHistory, $skills, $education] : [];

            // Status code: 200 if profile found: else 404.
            $statusCode = $profile == null ? 404 : 200;

            // status message
            $message = $profile == null ? "No profile found" : "success";
        } catch (\Exception $e) {

            // if error, return a 500 status code in a DTO
            $statusCode = 500;
            $message = "It broke";
            $resultArr = [];
        } finally {

            // return result
            return json_encode(new DTO($statusCode, $message, $resultArr), JSON_PRETTY_PRINT);
        }
    }
}
