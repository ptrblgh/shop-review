<?php

namespace Shopreview\Mvc\Controller;

use Shopreview;
use Shopreview\Helper;
use ShopReview\Session;
use Shopreview\Mvc\Model\Review;
use Shopreview\Mvc\Model\ReviewDbRepository;
use Shopreview\Validator\FormValidator\ReviewFormValidator;

class ReviewController extends BaseController
{
    /**
     * Mysql database repository for user
     * 
     * @var MysqlDb
     */
    protected $userRepository;

    /**
     * Constructor for Controller
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Save/update review
     * 
     * @return void
     */
    public function addAction()
    {
        $data = Helper::sanitizeInput($_POST);

        $validator = new ReviewFormValidator($this->getReviewRepository());

        if ($validator->isValid($data)) {
            $res = $this->getReviewRepository()->saveReview($data);
        } else {
            Session::getInstance()->form_errors = $validator->getErrors();
        }

        header('Location: /', true, 302);
        exit();
    }

    /**
     * Delete review
     * 
     * @return void
     */
    public function delAction()
    {
        $username = Session::getInstance()->username;
        $res = $this->getReviewRepository()->delReview($username);

        header('Location: /', true, 302);
        exit();
    }

    /**
     * Lazy-load user database repository
     * 
     * @return MysqlDb
     */
    public function getUserRepository()
    {
        if (!$this->userRepository) {
            $dbConfig = $this->appConfig['db'];

            $this->userRepository = UserDbRepository::getInstance(
                $dbConfig['server'],
                $dbConfig['driver'],
                $dbConfig['username'],
                $dbConfig['password'],
                $dbConfig['dbname']
            );
        }

        return $this->userRepository;
    }
}
