<?php
/**
 * version 2.0
 *
 * Student Name: Ali, Connor
 * Course Number: CST-256
 * Date: 1/31/2018
 * This assignment was completed in collaboration with Connor Low, Ali Cooper.
 * We used source code from the following websites to complete this assignment: N/A
 *
 * 4/5/18: Added Education, Skills, and Employment history for REST API.
 */

namespace App\Model;

class UserProfileModel implements \JsonSerializable
{
    private $id, $imgURL, $uid, $bio, $location;
    private $education, $skills, $employment;

    /**
     * UserProfileModel constructor.
     * @param string $imgURL
     * @param string $bio
     * @param string $location
     */
    public function __construct($imgURL = "", $bio = "", $location = "")
    {
        $this->imgURL = $imgURL;
        $this->bio = $bio;
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getEducation() : array
    {
        return $this->education;
    }

    /**
     * @param mixed $education
     */
    public function setEducation(array $education)
    {
        $this->education = $education;
    }

    /**
     * @return mixed
     */
    public function getSkills() : array
    {
        return $this->skills;
    }

    /**
     * @param mixed $skills
     */
    public function setSkills(array $skills)
    {
        $this->skills = $skills;
    }

    /**
     * @return mixed
     */
    public function getEmployment() : array
    {
        return $this->employment;
    }

    /**
     * @param mixed $employment
     */
    public function setEmployment(array $employment)
    {
        $this->employment = $employment;
    }


    public static function getFields()
    {
        return ['ID', 'Location', 'Biography'];
    }

    public function getJobFieldsArr()
    {
        return [$this->id, $this->location, $this->bio];
    }

    /**
     * @return mixed
     */
    public function getImgURL()
    {
        return $this->imgURL;
    }

    /**
     * @param mixed $imgURL
     */
    public function setImgURL($imgURL)
    {
        $this->imgURL = $imgURL;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}