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
class EducationModel
{

    private $id, $uid, $institution, $level, $degree;

    /**
     * EducationModel constructor.
     * @param $id
     * @param $uid
     * @param $institution
     * @param $level
     * @param $degree
     */
    public function __construct($id = -1, $uid, $institution, $level, $degree)
    {
        $this->id = $id;
        $this->uid = $uid;
        $this->institution = $institution;
        $this->level = $level;
        $this->degree = $degree;
    }

    public static function getFields()
    {
        return ['Institution', 'Degree', 'Program'];
    }

    public function getEducationFieldsArr()
    {
        return [$this->institution, $this->level, $this->degree];
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
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * @param mixed $institution
     */
    public function setInstitution($institution): void
    {
        $this->institution = $institution;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level): void
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * @param mixed $degree
     */
    public function setDegree($degree): void
    {
        $this->degree = $degree;
    }


}