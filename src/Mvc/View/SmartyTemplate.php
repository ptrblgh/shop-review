<?php

namespace Shopreview\Mvc\View;

use Shopreview\Session;

/**
 * Smarty templating engine wrapper
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class SmartyTemplate implements TemplateInterface
{
    /**
     * Smarty template file extension
     */
    const EXTENSION = '.tpl';

    /**
     * Template files' path
     * 
     * @var string|null
     */
    protected $path = null;

    /**
     * The template file to render
     * 
     * @var string|null
     */
    protected $fileName = null;

    /**
     * Smarty object
     * 
     * @var \Smarty
     */
    protected $template = null;

    /**
     * Parameters from the controller to the view
     * 
     * @var array
     */
    protected $templateParams = array();

    /**
     * Constructor for setting class data
     * 
     * @param string $templatePath
     * @param string $templateFileName
     * @param array $templateParams
     * @return void
     */
    public function __construct(
        $templatePath, 
        $templateFileName, 
        $templateParams
    ) {
        $this->path = $templatePath;

        if (class_exists('Smarty')) {
            $this->template = new \Smarty();
        } else {
            throw new \Exception("Failed to load Smarty. Class does not exist.");
        }
        $this->template->template_dir = $this->path . DS . 'templates';
        $this->template->compile_dir = $this->path . DS . 'templates_c';
        $this->template->cache_dir = $this->path . DS . 'cache';
        $this->template->config_dir = $this->path . DS . 'config';

        $this->fileName = $templateFileName . self::EXTENSION;
        $this->templateParams = $templateParams;
    }

    /**
     * Renderer function
     * 
     * @return string text/html
     */
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
