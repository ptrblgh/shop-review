<?php

namespace Shopreview\Mvc\View;

use Shopreview\Session;

class SmartyTemplate implements TemplateInterface
{
    const EXTENSION = '.tpl';

    protected $path = null;
    protected $fileName = null;
    protected $template = null;
    protected $templateParams = array();

    public function __construct(
        $templatePath, 
        $templateFileName, 
        $templateParams
    ) {
        $this->path = $templatePath;

        $this->template = new \Smarty();
        $this->template->template_dir = $this->path . DS . 'templates';
        $this->template->compile_dir = $this->path . DS . 'templates_c';
        $this->template->cache_dir = $this->path . DS . 'cache';
        $this->template->config_dir = $this->path . DS . 'config';

        $this->fileName = $templateFileName . self::EXTENSION;
        $this->templateParams = $templateParams;
    }

    public function display()
    {
        if (is_array($this->templateParams)) {
            foreach ($this->templateParams as $var => $val) {
                $this->template->assign($var, $val);
            }
        }

        // no form error messages on next request
        Session::getInstance()->form_errors = null;

        // setting utf-8 header
        header('Content-Type: text/html; charset=utf-8');
        
        return $this->template->fetch($this->fileName);
    }
}
