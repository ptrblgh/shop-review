<?php

namespace Shopreview\Mvc\Controller;

use Shopreview;
use Shopreview\Helper;
use Shopreview\Mvc\Model\Review;
use Shopreview\Mvc\Model\ReviewDbRepository;
use Shopreview\Mvc\View\JsonTemplate;
use Shopreview\Mvc\View\SmartyTemplate;
use ShopReview\Session;
use Shopreview\Validator\FormValidator\ReviewFormValidator;

/**
 * Controller for review-related actions
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
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
     *
     * @return void
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
     * Get reviews on scroll
     * 
     * @return string application/json
     */
    public function batchAction()
    {
        $data = Helper::sanitizeInput($_POST);

        if (!empty(Session::getInstance()->username)) {
            $reviewOptions = array(
                'exclude' => Session::getInstance()->username,
                'start' => $data['itemCount'] + 1,
                'batch' => $this->appConfig['reviews']['batch']
            );
        } else {
            $reviewOptions = array(
                'exclude' => '',
                'start' => $data['itemCount'] + 1,
                'batch' => $this->appConfig['reviews']['batch']
            );            
        }

        $ret = $this->getReviewRepository()->fetchAll($reviewOptions);

        if ($ret) {
            $templatePath = $this->appConfig['template_path'];

            $templateParams = array();

            $templateParams['reviews'] = $ret;

            $templateParams['review_lead'] 
                = $this->appConfig['reviews']['body_lead'];

            $view = new SmartyTemplate(
                $templatePath, 
                $this->getTemplateFileName('partial_reviews'), 
                $templateParams
            );

            echo $view->display();
        }
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
