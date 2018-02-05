<?php
/**
 * version 1.0
 *
 * Student Name: Ali
 * Course Number: CST-256
 * Date: 1/31/2018
 * This assignment was completed in collaboration with Connor Low, Ali Cooper.
 * We used source code from the following websites to complete this assignment: N/A
 */

namespace App\Model;

use App\Services\DatabaseAccess;
use PDO;
use PDOStatement;

class JobHistoryModel
{
    private $id,$uid, $employer, $salary, $title, $years_employed;

    /**
     * JobHistoryModel constructor.
     * @param $id
     * @param $uid
     * @param $employer
     * @param $salary
     * @param $title
     * @param $years_employed
     */
    public function __construct($id, $uid, $employer, $salary, $title, $years_employed) {
        $this->id = $id;
        $this->uid = $uid;
        $this->employer = $employer;
        $this->salary = $salary;
        $this->title = $title;
        $this->years_employed = $years_employed;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUid() {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid) {
        $this->uid = $uid;
    }

    /**
     * @return mixed
     */
    public function getEmployer() {
        return $this->employer;
    }

    /**
     * @param mixed $employer
     */
    public function setEmployer($employer) {
        $this->employer = $employer;
    }

    /**
     * @return mixed
     */
    public function getSalary() {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary) {
        $this->salary = $salary;
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getYearsEmployed() {
        return $this->years_employed;
    }

    /**
     * @param mixed $years_employed
     */
    public function setYearsEmployed($years_employed) {
        $this->years_employed = $years_employed;
    }

}