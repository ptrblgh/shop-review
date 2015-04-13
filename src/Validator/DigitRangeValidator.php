<?php

namespace Shopreview\Validator;

class DigitRangeValidator extends AbstractValidator
{
    /**
     * Options for validator
     *
     * @var array
     */    
    protected $options = array(
        'min' => 1,
        'max' => 5,
        'int' => true,
        'message' => 'Value is invalid.'
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
        $int = $this->getOption('int');

        if (!$int && is_numeric($data) && $data >= $min && $data <= $max) {
            
            return true;
        } elseif ($int 
            && (int) $data == $data
            && is_numeric($data) 
            && $data >= $min 
            && $data <= $max
        ) {
            
            return true;
        }
        
        return false;
    }
}
