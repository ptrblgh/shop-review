<?php

namespace Shopreview\Mvc;

class Template
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

        $this->template = new Smarty();
        $this->template->template_dir = $this->path.'/'.'templates';
        $this->template->compile_dir = $this->path.'/'.'templates_c';
        $this->template->cache_dir = $this->path.'/'.'cache';
        $this->template->config_dir = $this->path.'/'.'config';

        $this->fileName = $templateFileName . EXTENSION;
        $this->templateParams = $templateParams;
    }

    public function display()
    {
        if (is_array($this->templateParams)) {
            foreach ($this->templateParams as $var => $val) {
                $this->template->assign($var, $val);
            }
        }

        $this->template->display($fileName);
    }
}
