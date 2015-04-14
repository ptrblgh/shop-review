<?php

namespace Shopreview\Mvc\Controller;

use Shopreview\Db\MysqlDb;
use Shopreview\Mvc\Application;
use Shopreview\Mvc\Router;
use Shopreview\Mvc\View;
use Shopreview\Mvc\Model\ReviewDbRepository;
use ShopReview\Session;
use Shopreview\Validator\CaptchaValidator;
use Shopreview\Validator\CsrfValidator;

/**
 * Base action controller
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class BaseController
{

    /**
     * Application config
     * 
     * @var string[]
     */
    protected $appConfig = array();

    /**
     * Mysql database repository for review
     * 
     * @var MysqlDb
     */
    protected $reviewRepository;

    /**
     * Constructor for Controller
     *
     * @return void
     */
    public function __construct()
    {
        $application = Application::getInstance();
        $this->appConfig = $application->getConfig();
    }

    /**
     * Homepage for site
     * 
     * @return string text/html
     */
    public function indexAction()
    {
        // get the root path for template files
        $templatePath = $this->appConfig['template_path'];

        // this array will be passed to the template engine to create actual
        // template variables inside views
        $templateParams = array();
        
        // sets logged in username
        $templateParams['logged_in'] 
            = (Session::getInstance()->username !== '') 
                ? Session::getInstance()->username 
                : null
            ;

        // csrf token and captcha for forms
        if (!empty($templateParams['logged_in'])) {
            // for login and register
            $csrf = new CsrfValidator();
            $csrfToken = $csrf->generateToken();
            $templateParams['csrf_token'] = $csrfToken;

            $captcha = new CaptchaValidator();
            $captchaArr = $captcha->generateCaptcha();
            $templateParams['register_captcha'] = $captchaArr;

            $reviewOptions = array(
                'exclude' => Session::getInstance()->username,
                'batch' => $this->appConfig['reviews']['batch']
            );
        } else {
            // for add/update review and change password
            $csrf = new CsrfValidator();
            $csrfToken = $csrf->generateToken();
            $templateParams['csrf_token'] = $csrfToken; 

            $reviewOptions = array(
                'exclude' => '',
                'batch' => $this->appConfig['reviews']['batch']
            );           
        }

        // transfer errors for views
        $templateParams['form_errors'] = 
            (Session::getInstance()->form_errors !== '') 
                ? Session::getInstance()->form_errors : null
        ;

        // others review
        $templateParams['reviews']
            = $this->getReviewRepository()->fetchAll($reviewOptions);

        // the logged in user's review
        $templateParams['logged_in_review'] = $this->getReviewRepository()
            ->findReview(Session::getInstance()->username);

        // average shop rating
        $templateParams['average_rating']
            = $this->getReviewRepository()->getAverageRating();

        // review lead length from application config
        $templateParams['review_lead'] 
            = $this->appConfig['reviews']['body_lead'];

        // pass information to the smarty view
        $view = new View\SmartyTemplate(
            $templatePath, 
            $this->getTemplateFileName(__FUNCTION__), 
            $templateParams
        );

        // explicitly close database connection
        $this->getReviewRepository()->close();

        echo $view->display();
    }

    /**
     * Returns the temaplate's filename without extension
     * 
     * @param string $functionName
     * @return string
     */
    public function getTemplateFileName($functionName)
    {
        if ($functionName) {
            $templateFileName 
                = str_replace(Router::ACTION_POSTFIX, '', $functionName);           
        } else {
            $templateFileName = Router::DEFAULT_ACTION;
        }

        return $templateFileName;
    }

    /**
     * Lazy-load review database repository
     * 
     * @return MysqlDb
     */
    public function getReviewRepository()
    {
        if (!$this->reviewRepository) {
            $dbConfig = $this->appConfig['db'];

            $this->reviewRepository = ReviewDbRepository::getInstance(
                $dbConfig['server'],
                $dbConfig['driver'],
                $dbConfig['username'],
                $dbConfig['password'],
                $dbConfig['dbname']
            );
        }

        return $this->reviewRepository;
    }
}
