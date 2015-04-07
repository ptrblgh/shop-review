<?php

namespace Shopreview\Mvc;

use Shopreview\Helper\Helper;
use Shopreview\Helper\Session;
use Shopreview\Helper\MysqlDbAdapter;

class Controller
{
    /**
     * Application config
     * 
     * @var array
     */
    protected $appConfig;

    /**
     * Default prefix for actions parsed from route
     * 
     * @var string
     */
    protected $defaultActionPrefix;

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
        $this->defaultActionPrefix = Router::ACTION_PREFIX;
    }

    /**
     * Homepage for site
     * 
     * @return string text/html
     */
    public function indexAction()
    {
        $templateFileName 
            = str_replace($this->defaultActionPrefix, '', __FUNCTION__);
        $templatePath = $this->appConfig['template_path'];
        $templateParams = array();
        
        // sets variable for template if logged in
        $templateParams['logged_in'] = 
            (isset(Session::getInstance()->username)) 
                ? Session::getInstance()->username : null
        ;
        $this->getDbAdapter();
        $view = new SmartyTemplate(
            $templatePath, 
            $templateFileName, 
            $templateParams
        );

        return $view->display();
    }

    /**
     * Create new password for email
     * 
     * @return string application/json
     */
    public function forgotAction()
    {
        $data = Helper::sanitizeInput($_POST['email']);
        $view = new JsonTemplate($data);

        $view->display();
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
