<?php
/*
version 2.1

Ali
CST-256
February 4, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

namespace App\Model;


class EmploymentHistoryModel
{

    private $id, $uid, $employer, $position, $duration;

    /**
     * EmploymentHistoryModel constructor.
     * @param $id
     * @param $uid
     * @param $employer
     * @param $position
     * @param $duration
     */
    public function __construct($id, $uid, $employer, $position, $duration)
    {
        $this->id = $id;
        $this->uid = $uid;
        $this->employer = $employer;
        $this->position = $position;
        $this->duration = $duration;
    }

    public static function getFields()
    {
        return ['Employer', 'Position', 'Duration'];
    }

    public function getJobFieldsArr()
    {
        return [$this->employer, $this->position, $this->duration];
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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @return mixed
     */
    public function getEmployer()
    {
        return $this->employer;
    }

    /**
     * @param mixed $employer
     */
    public function setEmployer($employer): void
    {
        $this->employer = $employer;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position): void
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }


}