<?php
/**
 * Student Name: Connor Low
 * Course Number: CST-256
 * Date: 1/22/2018
 * This is my own work.
 */
class UserBusinessService
{

    private $user;
    private $cardNum;
    private $cardDate;

    /**
     * UserBusinessService constructor.
     * @param User $user
     * @param $cardNum
     * @param $cardDate
     */
    public function __construct(User $user, $cardNum = FALSE, $cardDate = FALSE)
    {
        $this->user = $user;
        $this->cardNum = $cardNum;
        $this->cardDate = $cardDate;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return bool|mysqli_result
     */
    public function loginUser()
    {
        // check for any input
        if (trim($this->user->getusername()) == "" || trim($this->user->getpassword()) == "" ||
            strlen($this->user->getUsername()) > 30 || strlen($this->user->getPassword() > 50))
            return FALSE;

        // connect to USER table through Data Service
        $service = new UserDataService();
        $result = $service->read($this->user->getUsername(), $this->user->getPassword());
        return $result->num_rows == 1 ? $result : FALSE;
    }

    /**
     * @return bool|mysqli_result
     */
    public function registerUser()
    {
        $service = new UserDataService();

        // firstName must not be empty
        if ($this->user->getFirstName() == NULL || trim($this->user->getFirstName() == "") ||
            strlen($this->user->getFirstName()) > 30)
            return FALSE;


        // lastName must not be empty
        if ($this->user->getLastName() == NULL || trim($this->user->getLastName()) == "" ||
            strlen($this->user->getLastName()) > 30)
            return FALSE;


        // username must not be empty and must not be taken
        if ($this->user->getUsername() == NULL || trim($this->user->getUsername()) == "" ||
            strlen($this->user->getUsername()) > 30)
            return FALSE;

        // password be at least 4 characters
        if ($this->user->getPassword() == NULL || strlen($this->user->getPassword()) < 4 ||
            strlen($this->user->getPassword()) > 50)
            return FALSE;


        // credit card must be 16 characters
        if ($this->user->getCardN() == NULL || strlen($this->user->getCardN()) != 16 || FALSE ||
            strlen($this->user->getCardN()) != 16)
            return FALSE;

        // card date must be in format: YYYY/DD/MM
        if ($this->user->getCardED() == NULL || false)  //TODO implement date security - look for method
            return FALSE;
        $this->cardDate = "2020-01-01"; // Safe date

        // if all rules are followed, attempt registration
        return $service->insert($this->user);
    }

    /**
     * @return bool|mysqli_result
     */
    public function updateUser()
    {
        $errorCount = 0;
        $service = new UserDataService();

        // firstName must not be empty
        if ($this->user->getFirstName() == NULL || trim($this->user->getFirstName() == ""))
            return FALSE;


        // lastName must not be empty
        if ($this->user->getLastName() == NULL || trim($this->user->getLastName()) == "")
            return FALSE;


        // username must not be empty and must not be taken
        if ($this->user->getUsername() == NULL || trim($this->user->getUsername()) == "")
            return FALSE;

        // password be at least 4 characters
        if ($this->user->getPassword() == NULL || strlen($this->user->getPassword()) < 4)
            return FALSE;


        // credit card must be 16 characters
        if ($this->user->getCardN() == NULL || strlen($this->user->getCardN()) != 16 || FALSE)
            return FALSE;

        // card date must be in format: YYYY/DD/MM
        if ($this->user->getCardED() == NULL || false)  //TODO implement date security - look for method
            return FALSE;
        $this->cardDate = "2020-01-01"; // Safe date

        // if all rules are followed, attempt registration
        if ($errorCount == 0) {
            return $service->update($this->user);
        }
        return FALSE;
    }

    /**
     * @return bool|mysqli_result
     */
    public function checkForUsername()
    {
        $service = new UserDataService();
        return $service->readUsername($this->user->getUsername());
    }

}