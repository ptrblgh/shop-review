<?php

namespace Shopreview\Mvc\Controller;

use Shopreview\Db\MysqlDb;
use ShopReview\Session;
use Shopreview\Mvc\Application;
use Shopreview\Mvc\Model\ReviewDbRepository;
use Shopreview\Mvc\Router;
use Shopreview\Mvc\View;
use Shopreview\Validator\CaptchaValidator;
use Shopreview\Validator\CsrfValidator;

/**
 * Basic action controller
 */
class BaseController
{

    /**
     * Application config
     * 
     * @var array
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
        $templatePath = $this->appConfig['template_path'];
        $templateParams = array();
        
        // sets variable for template if logged in
        $templateParams['logged_in'] 
            = (Session::getInstance()->username !== '') 
                ? Session::getInstance()->username 
                : null
            ;

        // csrf tokens for forms (register, login)
        if (!empty($templateParams['logged_in'])) {
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
            $csrf = new CsrfValidator();
            $csrfToken = $csrf->generateToken();
            $templateParams['csrf_token'] = $csrfToken; 

            $reviewOptions = array(
                'exclude' => '',
                'batch' => $this->appConfig['reviews']['batch']
            );           
        }

        $templateParams['form_errors'] = 
            (Session::getInstance()->form_errors !== '') 
                ? Session::getInstance()->form_errors : null
        ;

        $templateParams['reviews']
            = $this->getReviewRepository()->fetchAll($reviewOptions);

        $templateParams['review_lead'] 
            = $this->appConfig['reviews']['body_lead'];

        $view = new View\SmartyTemplate(
            $templatePath, 
            $this->getTemplateFileName(__FUNCTION__), 
            $templateParams
        );

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
