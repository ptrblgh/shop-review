<?php

namespace Shopreview\Mvc\View;

/**
 * Templating interface for views
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
interface TemplateInterface
{
    /**
     * Renderer function
     * 
     * @return string
     */
    public function display();
}
