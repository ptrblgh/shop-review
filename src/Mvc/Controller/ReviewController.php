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
     * Mysql database repository for review
     * 
     * @var MysqlDb
     */
    protected $reviewRepository;

    /**
     * Constructor for Controller
     */
    public function __construct()
    {
        parent::__construct();
    }
}
