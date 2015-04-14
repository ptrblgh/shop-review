<?php

namespace Shopreview\Mvc\Model;

use Shopreview\Db\MysqlDb;
use Shopreview\Mvc\Model\User;

/**
 * Database repository for user
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class UserDbRepository extends MysqlDb
{
    /**
     * Find user by username
     * 
     * @param  string $value
     * @return User
     */
    public function findUser($value)
    {
        $q = 'SELECT * FROM `shop-review_user` WHERE `username` = :value';

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->setFetchMode(\Pdo::FETCH_INTO, new User());
            $stmt->execute(array('value' => $value));
        } catch (\PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return $stmt->fetch();
    }

    /**
     * Find user by its username
     * 
     * @param string $value username
     * @return object
     */
    public function findUsername($value)
    {
        $q = 'SELECT `username` FROM `shop-review_user` WHERE `username` = :value';

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->setFetchMode(\Pdo::FETCH_INTO, new User());
            $stmt->execute(array('value' => $value));
        } catch (\PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return $stmt->fetch();
    }

    /**
     * Find user's email
     * 
     * @param string $value username
     * @return object
     */
    public function findEmail($value)
    {
        $q = 'SELECT `email` FROM `shop-review_user` WHERE `email` = :value';

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
     * Find user by email
     * 
     * @param string $value username
     * @return object
     */
    public function findByEmail($value)
    {
        $q = 'SELECT * FROM `shop-review_user` WHERE `email` = :value';

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->setFetchMode(\Pdo::FETCH_INTO, new User());
            $stmt->execute(array('value' => $value));
        } catch (\PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return $stmt->fetch();
    }

    /**
     * Insert registration data into database
     * 
     * @param array $data
     * @return boolean
     */
    public function saveUser($data)
    {
        $q = "INSERT INTO `shop-review_user` "
            . "(`username`, `password`, `email`) "
            . "VALUES (:register_username, :register_psw, :register_email)"
        ;

        try {
            $stmt = $this->connection->prepare($q);
            $ret = $stmt->execute(array(
                'register_username' => $data['register_username'],
                'register_psw' => $data['crypted_psw'],
                'register_email' => $data['register_email']
            ));

            return $ret;
        } catch (\PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }
    }

    /**
     * Update user's password
     * 
     * @param User $user
     * @return boolean
     */
    public function updateUserPassword(User $user)
    {
        $q = "UPDATE `shop-review_user` SET "
            . "`password` = :psw "
            . "WHERE `username` = :usr"
        ;

        try {
            $stmt = $this->connection->prepare($q);
            $ret = $stmt->execute(array(
                'psw' => $user->password,
                'usr' => $user->username
            ));

            return $ret;
        } catch (\PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return false;
    }
}
