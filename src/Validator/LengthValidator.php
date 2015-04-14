<?php

namespace Shopreview\Validator;

/**
 * String length validator
 *
 * Checks if the given string is between the options values.
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
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
     * Checks if the string length is in range
     * 
     * @param string $data
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
