<?php

namespace Shopreview\Validator\FormValidator;

use Shopreview\Validator\ValidatorInterface;

/**
 * Abstract class for form validators
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
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
