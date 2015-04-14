<?php

namespace Shopreview\Mvc\Model;

use Shopreview\Db\MysqlDb;
use Shopreview\Session;

/**
 * Database repository for reviews
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class ReviewDbRepository extends MysqlDb
{
    /**
     * Retrive all reviews
     *
     * @param string[] $options
     * @return Shopreview\Mvc\Model\Review
     */
    public function fetchAll($options = array())
    {
        $exclude = '';
        $limit = '';
        $valueArr = array();
        $start = (!empty($options['start']) ? (int) $options['start'] : 0);
        $batch = (!empty($options['batch']) ? (int) $options['batch'] : 1);

        // only a limited set is needed so we construct the sql query for it
        if ($batch > 0) {
            $limit = ' LIMIT :start, :batch';
            $valueArr['start'] = $start;
            $valueArr['batch'] = $batch;
        }

        // exclude this user's review (the logged in), because that user's
        // review data is in the form on the homepage
        if (!empty($options['exclude'])) {
            $exclude = ' WHERE `username` != :exclude';
            $valueArr['exclude'] = $options['exclude'];
        }

        $q = 'SELECT * FROM `shop-review_review`' . $exclude;
        $q .= ' ORDER BY `review_add_date` DESC';
        $q .= $limit;

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->bindParam(':start', $valueArr['start'], \Pdo::PARAM_INT);
            $stmt->bindParam(':batch', $valueArr['batch'], \Pdo::PARAM_INT);
            if (!empty($options['exclude'])) {
                $stmt->bindParam(
                    ':exclude', 
                    $valueArr['exclude'], 
                    \Pdo::PARAM_STR
                );
            }
            $stmt->execute();
        } catch (\PdoException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return $stmt->fetchAll(
            \Pdo::FETCH_CLASS, 
            'Shopreview\Mvc\Model\Review'
        );
    }

    /**
     * Find review by username
     * 
     * @param string $value username
     * @return Shopreview\Mvc\Model\Review
     */
    public function findReview($value)
    {
        $q = 'SELECT * FROM `shop-review_review` WHERE `username` = :value';

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->setFetchMode(\Pdo::FETCH_INTO, new Review());
            $stmt->execute(array('value' => $value));
        } catch (\PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return $stmt->fetch();
    }

    /**
     * Save/update review
     * 
     * @param array $value
     * @return boolean
     */
    public function saveReview($value)
    {
        $username = Session::getInstance()->username;
        $reviewExist = $this->findReview($username);
        // user already wrote a review so we update that one
        if ($reviewExist) {
            $q = "UPDATE `shop-review_review` SET"
                . "`review_body` = :body, "
                . "`review_rating` = :rating, "
                . "`review_edit_date` = NOW() "
                . "WHERE `username` = :username"
            ;
        // this will be a new review for the user
        } else {
            $q = "INSERT INTO `shop-review_review` ("
                . "`review_body`, " 
                . "`review_rating`, "
                . "`review_edit_date`, "
                . "`username`)"
                . " VALUES ("
                . ":body, "
                . ":rating, "
                . "NOW(), "
                . ":username)"
            ;
        }

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->bindParam(
                ':body', 
                $value['review_review_body'], 
                \Pdo::PARAM_STR
            );
            $stmt->bindParam(
                ':rating', 
                $value['review_review_rating'], 
                \Pdo::PARAM_INT
            );

            $stmt->bindParam(
                ':username', 
                $username, 
                \Pdo::PARAM_STR
            );
            
            $ret = $stmt->execute();

            return $ret;
        } catch (\PdoException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }
    }

    /**
     * Delete review by username
     * 
     * @param string $value username
     * @return boolean
     */
    public function delReview($value)
    {
        $q = 'DELETE FROM `shop-review_review` WHERE `username` = :value';

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->bindParam(':value', $value, \Pdo::PARAM_STR);
            $stmt->execute();
        } catch (\PdoException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return $stmt->fetch();
    }

    /**
     * Get the average rating of the shop
     * 
     * @return object
     */
    public function getAverageRating()
    {
        $q = 'SELECT AVG(`review_rating`) AS `avg_rating` FROM `shop-review_review`';

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->execute();
        } catch (\PdoException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return $stmt->fetch(\Pdo::FETCH_OBJ);
    }


}
