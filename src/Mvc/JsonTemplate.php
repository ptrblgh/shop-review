<?php

namespace Shopreview\Mvc;

class JsonTemplate implements TemplateInterface
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function display()
    {
        header('Content-Type: application/json');
        echo json_encode($this->data);
    }
}
