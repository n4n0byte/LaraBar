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

class UserProfileModel {
    private $id, $imgURL, $uid, $bio, $location, $education, $employmentHistory;

    /**
     * UserModel constructor.
     * @param $id
     * @param $imgURL
     * @param $uid
     * @param $bio
     * @param $location
     * @param $education
     */
    public function __construct($imgURL = "", $bio = "", $location = "", $education = "", $employmentHistory = "") {
        $this->employmentHistory = $employmentHistory;
        $this->imgURL = $imgURL;
        $this->bio = $bio;
        $this->location = $location;
        $this->education = $education;
    }

    /**
     * @return mixed
     */
    public function getImgURL() {
        return $this->imgURL;
    }

    /**
     * @param mixed $imgURL
     */
    public function setImgURL($imgURL) {
        $this->imgURL = $imgURL;
    }

    /**
     * @return mixed
     */
    public function getUid() {
        return $this->uid;


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
     * @param mixed $uid
     */
    public function setUid($uid) {
        $this->uid = $uid;
    }

    /**
     * @return mixed
     */
    public function getBio() {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio) {
        $this->bio = $bio;
    }

    /**
     * @return mixed
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location) {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getEducation() {
        return $this->education;
    }

    /**
     * @param mixed $education
     */
    public function setEducation($education) {
        $this->education = $education;
    }

    /**
     * @return mixed
     */
    public function getEmploymentHistory() {
        return $this->employmentHistory;
    }

    /**
     * @param mixed $employmentHistory
     */
    public function setEmploymentHistory($employmentHistory) {
        $this->employmentHistory = $employmentHistory;
    }


}