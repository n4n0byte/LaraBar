<?php
/*
version 2.1

Ali, Connor
CST-256
February 4, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Model\UserProfileModel;
use App\Services\Business\SuspendUserBusinessService;
use App\Services\Business\UserBusinessService;
use App\Services\Business\UserProfileBusinessService;
use App\Services\Utility\ILogger;
use App\Services\Utility\LarabarLogger;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /* @var $logger ILogger */
    protected $logger;

    /**
     * AuthenticationController constructor.
     * @param ILogger $logger
     */
    public function __construct(ILogger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login_error()
    {
        $this->logger->info("AuthenticationController::login_error()", []);
        return view('login_error');
    }

    /**
     * registers user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register(Request $request)
    {
        $this->logger->info("AuthenticationController::register()", []);
        try {
            // validation
            $this->validateRegistration($request);

            // get inputs
            $inputEmail = $request->input('email');
            $inputPassword = $request->input('password');
            $inputFirstName = $request->input('firstName');
            $inputLastName = $request->input('lastName');

            // create UserModel
            $user = new UserModel(0, $inputEmail, $inputPassword, $inputFirstName, $inputLastName);

            // create a business service
            $service = new UserBusinessService($user);

            // attempt registration
            if ($user = $service->register()) {
                session()->put(['UID' => $user->getId()]);
                session()->save();

                // create default profile
                $profile = new UserProfileModel();
                $profileService = new UserProfileBusinessService();
                $profileService->initializeProfile($profile);

                return view("home")->with(['user' => $user]);
            } else {
                $data = [
                    'user' => $user,
                    'message' => $service->getStatus()
                ];
                return view("register")->with($data);
            }
        } catch (ValidationException $e) {
            throw $e;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * checks for valid inputs,
     * shows error page if input is invalid
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function login(Request $request)
    {
        $this->logger->info("AuthenticationController::login()", $request->input());

        // validation
        $this->validateLogin($request);

        // get inputs
        $inputEmail = $request->input('email');
        $inputPassword = $request->input('password');

        // create UserModel
        if ($inputPassword == "" || $inputEmail == "")
            return view("login")->with(['message' => "Please fill out all forms."]);
        $user = new UserModel(0, $inputEmail, $inputPassword);
        $this->logger->info("User successfully created", []);

        // create a business service
        $service = new UserBusinessService($user);

        // attempt login
        if ($status = $service->login()) {
            $susService = new SuspendUserBusinessService();
            session()->put(['user' => $user]);
            session()->save();
            return $susService->suspensionStatus($user) ? view("suspend") : view("home")->with(['user' => $user]);
        } else {
            return view("login")->with(['user' => $user, 'message' => $service->getStatus()]);
        }

    }

    /**
     * @param Request $request
     */
    public function validateLogin(Request $request)
    {
        $this->logger->info("AuthenticationController::validateLogin", $request->input());

        // Define rules
        $rules = [
            'email' => 'Required|Between:5,60|E-Mail',
            'password' => 'Required|Between:4,25'
        ];

        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            $this->logger->warning("Validation failed: " . $ve, $rules);
            throw $ve;
        }
    }

    /**
     * @param Request $request
     */
    public function validateRegistration(Request $request)
    {
        $this->logger->info("AuthenticationController::validateRegistration", $request->input());
        // Define rules
        $rules = [
            'email' => 'Required|Between:5,60|E-Mail',
            'password' => 'Required|Between:4,25',
            'firstName' => 'Required|Alpha|Between:2,25',
            'lastName' => 'Required|Alpha|Between:2,25',
        ];

        // Run checks
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            $this->logger->warning("Validation failed: " . $ve, $rules);
            throw $ve;
        }
    }
}
