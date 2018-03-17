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

class JobModel
{

    private $id, $title, $author, $location;
    private $description, $requirements, $salary;

    /**
     * JobModel constructor.
     * @param $id
     * @param $title
     * @param $author
     * @param $location
     * @param $description
     * @param $requirements
     * @param $salary
     */
    public function __construct(  $id, $title, $author, $location, $description, $requirements, $salary)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->location = $location;
        $this->description = $description;
        $this->requirements = $requirements;
        $this->salary = $salary;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
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
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * @param mixed $requirements
     */
    public function setRequirements($requirements): void
    {
        $this->requirements = $requirements;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary): void
    {
        $this->salary = $salary;
    }

    public static function getFields()
    {
        return ['ID', 'Title', 'Author', 'Location', 'Description', 'Requirements', 'Salary'];
    }

    public function getJobFieldsArr()
    {
        return [$this->id, $this->title, $this->author, $this->location,
            $this->description, $this->requirements, $this->salary];
    }

}