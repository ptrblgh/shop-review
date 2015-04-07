<?php

namespace Shopreview\Mvc;

class JsonTemplate implements TemplateInterface
{
    protected $data;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

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
