<?php

namespace App\Model;

class SkillsModel
{
    private $id, $uid, $title, $description;

    /**
     * SkillsModel constructor.
     * @param int $id
     * @param int $uid
     * @param string $title
     * @param string $description
     */
    public function __construct($id = -1, $uid = -1, $title = "", $description = "")
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->uid = $uid;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUid(): int
    {
        return $this->uid;
    }

    /**
     * @param int $uid
     */
    public function setUid(int $uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public static function getFields()
    {
        return ['Title', 'Description'];
    }

    public function getSkillFieldsArr()
    {
        return [$this->title, $this->description];
    }


}