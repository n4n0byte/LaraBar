<?php
/**
 * Student Name: Connor Low
 * Course Number: CST-256
 * Date: 1/22/2018
 * This is my own work.
 */
class UserDataService
{
    private $ini;

    /**
     * User_DS constructor.
     * @param User $user
     */
    public function __construct()
    {
        $this->ini = parse_ini_file("../resource/db.ini", TRUE);
    }

    public function read($username, $password)
    {
        // call the ini file
        // the query takes the variables from the ini file
        $query = $this->ini['Select']['user'] . "USERNAME = '" . $username .
            "' and PASSWORD = '" . $password . "'";
        // connecting to database
        $connection = new Connection();
        $result = $connection->connect()->query($query);
        $connection->disconnect();
        return $result;
    }

    /**
     * Attempt to find a user with the provided username and return the ID.
     * @param $username
     * @return bool
     */
    public function readUsername($username)
    {
        $query = $this->ini['Select']['username'] . "'" . $username . "';";
        $connection = new Connection();
        $result = $connection->connect()->query($query);
        $connection->disconnect();
        return $result->num_rows > 0;
    }

    function insert(User $user)
    {
        $query = $this->ini['Insert']['user'] . "('" .
            $user->getUsername() . "', '" .
            $user->getPassword() . "', '" .
            $user->getFirstName() . "', '" .
            $user->getLastName() . "', '" .
            $user->getEmail() . "', '" .
            $user->getCardN() . "', '" .
            $user->getCardED() . "', '" .
            $user->getCardH() . "', '" .
            $user->getCardCVC() . "');";
        $connection = new Connection();
        $result = $connection->connect()->query($query);
        $connection->disconnect();
        return $result;
    }

    function update(User $user) {
        $query = $this->ini['Update']['user'] . "USERNAME = '" .
            $user->getUsername() . "', PASSWORD = '" .
            $user->getPassword() . "', FIRST_NAME = '" .
            $user->getFirstName() . "', LAST_NAME = '" .
            $user->getLastName() . "', EMAIL = '" .
            $user->getEmail() . "', CREDIT_CARD = '" .
            $user->getCardN() . "', CARD_DATE = '" .
            $user->getCardED() . "', CARD_HOLDER = '" .
            $user->getCardH() . "', CARD_CVC = '" .
            $user->getCardCVC() . "', BILLING_ADDRESS = '" .
            $user->getBillingAddress() . "' where ID = '" . $user->getId() . "';";
        $connection = new Connection();
        $result = $connection->connect()->query($query);
        $connection->disconnect();
        return $result;
    }
//update USER set
// USERNAME = 'ADMIN',
// PASSWORD = 'CST-236',
// FIRST_NAME = 'General',
// LAST_NAME = 'Administrator',
// EMAIL = 'clow2@my.gcu.edu',
// CREDIT_CARD = '1111222233334444',
// CARD_DATE = '2020-01-01',
// CARD_HOLDER = 'ADMIN TEST',
// CARD_CVC = '123';
}