<?php

namespace Shopreview\Validator\FormValidator;

use Shopreview\Validator\ValidatorInterface;

abstract class AbstractFormValidator implements ValidatorInterface
{
    /**
     * Validator error messages
     * 
     * @var array
     */
    protected $errors = array();

    /**
     * {inheritdoc}
     */
    abstract public function isValid($data);

    /**
     * Getter for error messages
     * 
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
