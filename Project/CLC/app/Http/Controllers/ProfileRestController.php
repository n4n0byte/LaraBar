<?php

namespace App\Http\Controllers;

use App\Model\DTO;
use App\Services\Business\UserProfileBusinessService;

class ProfileRestController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

            return json_encode($dto);
        } catch (Exception $e) {
            $dto = new DTO(500, "It broke", []);
            return json_encode($dto);
        }

    }

}
