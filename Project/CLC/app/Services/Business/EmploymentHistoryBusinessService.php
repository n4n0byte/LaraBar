<?php

/*
version 1.1

Ali, Connor
CST-256
April 27, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

namespace App\Services\Business;

use App\Model\EmploymentHistoryModel;
use App\Services\Data\EmploymentHistoryDataAccessService;
use App\Services\Utility\LarabarLogger;

/**
 * Business Service for processing data
 * then using Data Service CRUD operations
 * Class EmploymentHistoryBusinessService
 * @package App\Services\Business
 */
class EmploymentHistoryBusinessService
{

    private $employmentHistorySvc;

    /**
     * EmploymentHistoryBusinessService constructor.
     */
    public function __construct()
    {
        $this->employmentHistorySvc = new EmploymentHistoryDataAccessService();
    }

    /**
     * used: 1
     * Remove a User's employment history record from the database.
     * @param int $id
     */
    public function removeEmploymentHistory(int $id)
    {
        LarabarLogger::info("-> EmploymentHistoryBusinessService::removeEmploymentHistory");

        // Call data access service method.
        $this->employmentHistorySvc->deleteEmploymentRow($id);
    }

    /**
     * used: 2
     * Get employment history from database
     * @param int $id
     * @param bool $usePostId
     * @return array
     */
    public function getEmploymentHistory($id = -1, $usePostId = false)
    {
        LarabarLogger::info("-> EmploymentHistoryBusinessService::getEmploymentHistory");

        // return array of employment history models
        return $this->employmentHistorySvc->getEmploymentHistoryRows($id, $usePostId);
    }

    /**
     * used: 2
     * Create or update employment history records in database
     * @param EmploymentHistoryModel $model
     */
    public function updateEmploymentHistory(EmploymentHistoryModel $model)
    {
        LarabarLogger::info("-> EmploymentHistoryBusinessService::updateEmploymentHistory");

        // If id is greater than 0, record exists and is being updated. Else, call create function.
        if ($model->getId() > 0)
            $this->employmentHistorySvc->updateEmploymentHistoryRow($model);
        else
            $this->employmentHistorySvc->createEmploymentHistoryRow($model);

    }


}