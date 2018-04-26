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
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
     * registers user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register(Request $request)
    {
        $this->logger->info("AuthenticationController::register()", []);
        try {

            // validate request
            $this->validateRegistration($request);

            // create a business service to attempt registration
            $service = new UserBusinessService();
            if ($user = $service->register($request->input())) {

                // save user in session
                session()->put(['UID' => $user->getId()]);
                session()->save();

                // create default profile
                $profile = new UserProfileModel();
                $profileService = new UserProfileBusinessService();
                $profileService->initializeProfile($profile);

                return view("home")->with(['user' => $user]);
            } else {

                // If failed to register, return to register view with $data
                $data = [
                    'user' => $request->input(),
                    'message' => $service->getStatus()
                ];
                return view("register")->with($data);
            }
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            $this->logger->error("AdminController error: " . $e);
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
        $this->logger->info("AuthenticationController::login()", $request->input()["email"]);
        try {

            // validation
            $this->validateLogin($request);

            // create UserModel
            $user = new UserModel(0, $request->input()["email"], $request->input()["password"]);
            $this->logger->info("User successfully created", []);

            // create a business service to log in user
            $service = new UserBusinessService();
            $status = $service->login($request->input());

            // attempt login
            if ($status != null) {

                // check if user is suspended: return appropriate view (suspend/home)
                $susService = new SuspendUserBusinessService();
                if ($susService->suspensionStatus($status)) {

                    // remove session information
                    session()->forget(['UID', 'user']);

                    // return the suspension page
                    return view("suspend");
                }

                // return the user home page with the information from the database
                return view("home")->with(['user' => $status]);
            } else {

                // return the login page
                return view("login")->with(['user' => $user, 'message' => $service->getStatus()]);
            }
        } catch (ValidationException $ve) {
            $this->logger->warning("AdminController::validateJobPost validation exception");
            throw $ve;
        } catch (\Exception $e) {
            $this->logger->error("AdminController error: " . $e);
            return view("error");
        }

    }

    /**
     * @param Request $request
     */
    public function validateLogin(Request $request)
    {
        $this->logger->info("AuthenticationController::validateLogin", $request->input());

        // Define rules for email and password
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

        // Define rules for email, password, firstname, lastname
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
