<?php

namespace Shopreview\Mvc\Model;

use Shopreview\Db\MysqlDb;

class ReviewDbRepository extends MysqlDb
{
    /**
     * Retrive all reviews
     *
     * @param string $options
     * @return array
     */
    public function fetchAll($options = array())
    {
        $exclude = '';
        $limit = '';
        $valueArr = array();
        $start = (!empty($options['start']) ? (int) $options['start'] : 0);
        $batch = (!empty($options['batch']) ? (int) $options['batch'] : 1);

        if ($batch > 0) {
            $limit = ' LIMIT :start, :batch';
            $valueArr['start'] = $start;
            $valueArr['batch'] = $batch;
        }

        if (!empty($options['exclude'])) {
            $exclude = ' WHERE `username` != :exclude';
            $valueArr['exclude'] = $options['exclude'];
        }

        $q = 'SELECT * FROM `shop-review_review`' . $exclude;
        $q .= ' ORDER BY `review_add_date` DESC';
        $q .= $limit;

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->bindParam(':start',$valueArr['start'], \PDO::PARAM_INT);
            $stmt->bindParam(':batch',$valueArr['batch'], \PDO::PARAM_INT);
            if (!empty($options['exclude'])) {
                $stmt->bindParam(':exclude', $valueArr['exclude'], \PDO::PARAM_STR);
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
     * Find review username
     * 
     * @param string $value username
     * @return Review
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
}
