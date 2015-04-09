<?php

namespace Shopreview\Validator\FormValidator;

use Shopreview\Validator\ValidatorInterface;
use Shopreview\Validator\CsrfValidator;

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
        $this->nameIsEmpty($this->elements['register_name']);
        $this->checkCsrf(
            'register_csrf_token', 
            $this->elements['register_csrf_token']
        );
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
                // name needs to be empty always (if human)
                if (empty($val) && $key !== 'register_name') {
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

    /**
     * Checks name element (anti-bot)
     * 
     * @param string $data
     * @return booelan
     */
    public function nameIsEmpty($data)
    {
        if (!empty($data)) {
            $this->errors[] = 'No bots are allowed.';

            return false;
        }

        return true;
    }

    /**
     * Checks CSRF token (anti-bot)
     * 
     * @param string $data
     * @return booelan
     */
    public function checkCsrf($elementName, $token)
    {
        $csrf = new CsrfValidator();
        $valid = $csrf->checkToken($elementName, $token);

        if (!$csrf->isValid()) {
            $this->errors[] = 'Invalid CSRF token.';

            return false;            
        }

        return true;
    }

    // TODO: add add numbers captcha validation (Shopreview\Validator\Captcha)
}
