<?php
/**
 * version 1.0
 *
 * Student Name: Ali
 * Course Number: CST-256
 * Date: 4/8/2018
 * This assignment was completed in collaboration with Connor Low, Ali Cooper.
 * We used source code from the following websites to complete this assignment: N/A
 */

namespace app\Model;

/**
 * Data Transfer Object
 */
class DTO implements \JsonSerializable {

    private $statusCode, $msg, $data;

    /**
     * DTO constructor.
     * @param string $statusCode
     * @param string $msg
     * @param array $data
     */
    public function __construct($statusCode = "", $msg = "", $data = array() ){

        $this->data = $data;
        $this->msg = $msg;
        $this->statusCode = $statusCode;

    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize() {
        return get_object_vars($this);
    }


}