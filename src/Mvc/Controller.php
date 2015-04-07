<?php

namespace Shopreview\Mvc;

class Controller
{
    protected $appConfig;
    protected $defaultActionPrefix;

    public function __construct(array $appConfig)
    {
        $application = Application::getInstance();
        $this->appConfig = $application->getConfig();
        $this->defaultActionPrefix = Router::ACTION_PREFIX;
    }

    public function indexAction(array $params)
    {
        $templateFileName = str_replace($defaultActionPrefix, '', __METHOD__);
        $templatePath = $appConfig['template_path'];
        $view = new Template($templatePath, $templateFileName);

        return $view;
    }
}