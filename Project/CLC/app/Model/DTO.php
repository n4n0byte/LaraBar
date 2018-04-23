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
     * @return string
     */
    public function getStatusCode(): string {
        return $this->statusCode;
    }

    /**
     * @param string $statusCode
     */
    public function setStatusCode(string $statusCode): void {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
     */
    public function getMsg(): string {
        return $this->msg;
    }

    /**
     * @param string $msg
     */
    public function setMsg(string $msg): void {
        $this->msg = $msg;
    }

    /**
     * @return array
     */
    public function getData(): array {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void {
        $this->data = $data;
    }



    /**
     * @return array|mixed
     */
    public function jsonSerialize() {
        return get_object_vars($this);
    }


}