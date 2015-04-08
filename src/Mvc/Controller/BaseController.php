<?php

namespace Shopreview\Mvc\Controller;

use Shopreview\Helper\MysqlDbAdapter;
use ShopReview\Helper\Session;
use Shopreview\Mvc\Application;
use Shopreview\Mvc\Router;
use Shopreview\Mvc\View;

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
     * Database adapter
     * 
     * @var MysqlDbAdapter
     */
    protected $dbAdapter;

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
        $templateParams['logged_in'] = 
            (isset(Session::getInstance()->username)) 
                ? Session::getInstance()->username : null
        ;
        $this->getDbAdapter();
        $view = new View\SmartyTemplate(
            $templatePath, 
            $this->getTemplateFileName(__FUNCTION__), 
            $templateParams
        );

        return $view->display();
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
     * Lazy-load mysql database adapter
     * 
     * @return MysqlDbADapter
     */
    public function getDbAdapter()
    {
        if (!$this->dbAdapter) {
            $dbConfig = $this->appConfig['db'];

            $this->dbAdapter = MysqlDbAdapter::getInstance(
                $dbConfig['server'],
                $dbConfig['username'],
                $dbConfig['password'],
                $dbConfig['dbname']
            );
        }

        return $this->dbAdapter;
    }
}
