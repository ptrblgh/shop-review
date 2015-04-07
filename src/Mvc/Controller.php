<?php

namespace Shopreview\Mvc;

use Shopreview\Helper\Session;

class Controller
{
    protected $appConfig;
    protected $defaultActionPrefix;

    public function __construct()
    {
        $application = Application::getInstance();
        $this->appConfig = $application->getConfig();
        $this->defaultActionPrefix = Router::ACTION_PREFIX;
    }

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
        $view = new SmartyTemplate(
            $templatePath, 
            $templateFileName, 
            $templateParams
        );

        $view->display();
    }

    public function loginAction()
    {
        $view = new JsonTemplate();

        $view->display();
    }
}
