<?php

namespace Shopreview\Mvc;

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

        // setting utf-8 character coding for php
        mb_internal_encoding('UTF-8');
        header('Content-Type: text/html; charset=utf-8');

        $this->template->display($this->fileName);
    }
}
