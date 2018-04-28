<?php

namespace App\Http\Controllers;

use App\Services\Business\AdminGroupsBusinessService as AdminGroupService;
use App\Services\Utility\ILogger;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


/**
 * Responsible for managing groups,
 * specifically, allows for CRUD operations
 * and their corresponding views. Only accessible
 * to site administrators
 * Class AdminGroupController
 * @package app\Http\Controllers
 */
class AdminGroupController extends Controller
{

    private $adminSvc, $logger;

    /**
     * AdminGroupController constructor.
     * stores service and logger as member variables
     * @param ILogger $logger
     */
    public function __construct(ILogger $logger)
    {
        $this->adminSvc = AdminGroupService::getInstance();
        $this->logger = $logger;
    }

    /**
     * shows admin view with list of groups
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->logger->info("-> AdminGroupController::index");

        // try to get all groups from service
        try {
            $groups = $this->adminSvc->listAllGroups();

            // render view
            return view('admin_groups_view')->with(["groups" => $groups]);
        } catch (\PDOException $e) {
            $this->logger->error("AdminGroupController::index error");
            return view("error");
        }
    }

    /**
     * renders form to add a group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAddGroupView()
    {
        $this->logger->info("-> AdminGroupController::showAddGroupView");
        return view('add_group');
    }

    /**
     * Request variables passed in should be
     * groupName, groupDescription, groupSummary
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addGroup(Request $request): RedirectResponse
    {
        $this->logger->info("-> addGroup::index");
        try {

            // validate inputs follow rules
            $this->validateGroup($request);

            // create group using service. Pass user input
            $this->adminSvc->createGroup($request->input());

            // render view using index
            return redirect()->action("AdminGroupController@index");
        } catch (ValidationException $ve) {
            $this->logger->error("AdminGroupController::validateGroup exception");
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("AdminGroupController::addGroup error");
            return view("error");
        }
    }

    /**
     * Remove a group
     * @param $groupId
     * @return RedirectResponse
     */
    public function removeGroup($groupId)
    {
        $this->logger->info("-> AdminGroupController::removeGroup");
        try {

            // call delete group service method with ID
            $this->adminSvc->deleteGroup($groupId);

            // return view through index
            return redirect()->action("AdminGroupController@index");
        } catch (ValidationException $ve) {
            $this->logger->error("AdminGroupController::validateGroup exception");
            throw $ve;
        } catch (\PDOException $e) {
            $this->logger->error("AdminGroupController::removeGroup error");
            return view("error");
        }
    }

    /**
     * update the information of a group
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateGroupDetails(Request $request): RedirectResponse
    {
        $this->logger->info("-> AdminGroupController::updateGroupDetails");
        try {

            // make sure request inputs follow rules
            $this->validateGroup($request);

            // pass updated group information to service method
            $this->adminSvc->editGroupDetails($request->input());

            return redirect()->action('AdminGroupController@index');
        } catch (ValidationException $ve) {
            $this->logger->error("AdminGroupController::validateGroup exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * Render edit-group view
     * @param $id
     * @return $this
     */
    public function showEditGroupView($id)
    {
        $this->logger->info("-> AdminGroupController::showEditGroupView");
        try {

            // get group from group service
            $group = $this->adminSvc->getGroupById($id);

            // render group edit form with the group information
            return view('edit_group_info')->with(['group' => $group]);
        } catch (ValidationException $ve) {
            $this->logger->error("AdminGroupController::validateGroup exception");
            throw $ve;
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * Validate user input for groups
     * @param $request
     */
    public function validateGroup($request)
    {
        $this->logger->info("-> AdminGroupController::validateGroup");

        // Define rules
        $rules = [
            'title' => 'Required|Between:4,20',
            'description' => 'Required|Between:10,100',
            'summary' => 'Required|Between:1,100'
        ];

        try {
            $this->validate($request, $rules);
        } catch (ValidationException $ve) {
            $this->logger->error("AdminGroupController::validateGroup exception");
            throw $ve;
        }
    }


}