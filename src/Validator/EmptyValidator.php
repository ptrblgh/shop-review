<?php

namespace Shopreview\Validator;

class EmptyValidator extends AbstractValidator
{
    /**
     * Options for validator
     *
     * @var array
     */    
    protected $options = array(
        'message' => 'Value cannot be empty.'
    );

    /**
     * Constructor for validator
     * 
     * @param array $options
     * @return void
     */
    public function __construct($options = array())
    {
        parent::__construct($options);
    }

    /**
     * Checks if data is empty
     * 
     * @param $data
     * 
     * @return boolean
     */
    public function isValid($data)
    {
        if (!empty($data)) {

            return true;
        }

        return false;
    }
}
