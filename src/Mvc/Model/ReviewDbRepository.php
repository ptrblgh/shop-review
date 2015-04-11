<?php

namespace Shopreview\Mvc\Model;

use Shopreview\Db\MysqlDb;

class ReviewDbRepository extends MysqlDb
{
    /**
     * Find user by its username
     * 
     * @param string $value username
     * @return object
     */
    public function findUser($value)
    {
        $q = 'SELECT `username` FROM `shop-review_user` WHERE `username` = :value';

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->execute(array('value' => $value));
        } catch (\PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * Find user email in table
     * 
     * @param string $value username
     * @return object
     */
    public function findEmail($value)
    {
        $q = 'SELECT `username` FROM `shop-review_user` WHERE `email` = :value';

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->execute(array('username' => $value));
        } catch (\PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Insert registration data into database
     * 
     * @param array $data
     * @return boolean
     */
    public function saveRegistration($data)
    {
        $userNameExists 
            = isset($data['register_username']) 
                ? $this->findUser($data['register_username']) 
                : null
        ;
        $emailExists             
            = isset($data['register_email']) 
                ? $this->findUser($data['register_email']) 
                : null
        ;

        if ((!empty($data) && is_array($data)) 
            && (strlen($data['register_username']) >= 3 
                && strlen($data['register_username']) <= 20
                && !$userNameExists)
            && (strlen($data['register_psw']) >= 6
                && strlen($data['register_psw']) <= 72
                && $data['register_psw'] === $data['register_psw2'])
            && (!empty($data['register_email']) && !$emailExists)
        ) {
            $q = "INSERT INTO `shop-review_user` "
                . "(`username`, `password`, `email`) "
                . "VALUES (:register_username, :register_psw, :register_email)"
            ;

            try {
                $stmt = $this->connection->prepare($q);
                $stmt->execute(array(
                    'register_username' => $data['register_username'],
                    'register_psw' => $data['register_psw'],
                    'register_email' => $data['register_email']
                ));
            } catch (\PDOException $e) {
                trigger_error($e->getMessage(), E_USER_ERROR);

                return false;
            }
        }
    }
}
