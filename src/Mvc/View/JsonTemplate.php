<?php

namespace Shopreview\Mvc\View;

/**
 * Json Template class, output $data in json format
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class JsonTemplate implements TemplateInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * Constructor
     * 
     * @param array $data
     * @return void
     */
    public function __construct($data = null)
    {
        $this->data = $data;
    }

    /**
     * Render the output and sets the header to utf-8
     * 
     * @return string application/json
     */
    public function display()
    {
        header('Content-Type: application/json; charset=utf-8');
        ob_start();
        if (isset($this->data)) {
            echo json_encode($this->data);
        }
        ob_end_flush();
    }
}
