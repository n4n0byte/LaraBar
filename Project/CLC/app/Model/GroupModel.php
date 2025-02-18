<?php
/**
 * version 1.0
 *
 * Student Name: Connor
 * Course Number: CST-256
 * Date: 3/2/2018
 * This assignment was completed in collaboration with Connor Low, Ali Cooper.
 * We used source code from the following websites to complete this assignment: N/A
 */

namespace App\Model;


use App\Services\Utility\LarabarLogger;

class GroupModel implements \JsonSerializable
{
    private $name, $description, $summary, $id;

    /**
     * GroupModel constructor.
     * @param $name
     * @param $description
     * @param $summary
     * @param $id
     */
    public function __construct($id = -1, $name = "", $description = "", $summary = "")
    {
        LarabarLogger::info("GroupModel constructed");
        $this->name = $name;
        $this->description = $description;
        $this->summary = $summary;
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
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

    public function getFields(): array
    {
        return [$this->name, $this->description, $this->summary];
    }

    /**
     * returns array containing field names
     */
    public static function getFieldNames(): array
    {
        return ["Group Name", "Description", "Summary", "Edit"];
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }


}