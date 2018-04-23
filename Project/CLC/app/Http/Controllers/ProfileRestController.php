<?php

namespace App\Http\Controllers;

use App\Model\DTO;
use App\Services\Business\UserProfileBusinessService;

class ProfileRestController extends Controller
{

    /**
     * @return DTO
     */
    public function index(){
        return new DTO(400,"Input Error");
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

        try {

            $userSvc = new UserProfileBusinessService();
            $result = $userSvc->getProfileData($id);
            $statusCode = 200;
            $message = "success";

            if ($result == null) {
                $statusCode = 404;
                $message = "No profile found";
            }

            $dto = new DTO($statusCode, $message, $result);

        } catch (\Exception $e) {

            $dto = new DTO(500, "It broke", []);
        }

        return json_encode($dto);

    }

}
