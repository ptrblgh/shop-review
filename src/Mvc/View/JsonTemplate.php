<?php

namespace Shopreview\Mvc\View;

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
            $this->data = 'A new password was sent.';
            echo json_encode($this->data);
        }
        ob_end_flush();
    }
}
