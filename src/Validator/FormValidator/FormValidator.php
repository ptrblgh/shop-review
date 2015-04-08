<?php

namespace Shopreview\Validator\FormValidator;

use Shopreview\Validator\ValidatorInterface;

class FormValidator implements ValidatorInterface
{
    /**
     * Validator error messages
     * 
     * @var array
     */
    protected $errors = array();

    /**
     * Form element values
     * 
     * @var array
     */
    protected $elements;

    /**
     * Constructor for FormValidator
     *
     * If $required is empty, all elements are required
     * 
     * @param array $elements all form input values
     * @param array $required form inputs required
     */
    public function __construct(array $elements, $required = array())
    {
        $this->elements = $elements;
        $this->required($required);
    }

    /**
     * Check if $reuqired inputs has values
     * 
     * If $required is empty, all elements are required
     * 
     * @param array $required form inputs required
     * @return boolean
     */
    public function required($required)
    {
        if (empty($this->elements)) {
            return true;
        }

        foreach ($this->elements as $key => $val) {
            if (in_array($key, $required) || empty($required)) {
                if (empty($val)) {
                    $this->errors[] = 'Required fields are empty.';

                    return false;
                }
            }
        }        
    }

    /**
     * {inheritdoc}
     */
    public function isValid()
    {
        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    /**
     * Getter for error messages
     * 
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    // TODO: add csrf validation (Shopreview\Validator\Csrf)
    // TODO: add add numbers captcha validation (Shopreview\Validator\Captcha)
}
