<?php

namespace Shopreview\Validator;

class LengthValidator extends AbstractValidator
{
    /**
     * Options for validator
     *
     * @var array
     */    
    protected $options = array(
        'min' => 3,
        'max' => 20,
        'message' => 'Value length is invalid.'
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
     * @return boolean
     */
    public function isValid($data)
    {
        $min = $this->getOption('min');
        $max = $this->getOption('max');

        if (strlen($data) >= $min && strlen($data) <= $max) {
            
            return true;
        } 
        
        return false;
    }
}
