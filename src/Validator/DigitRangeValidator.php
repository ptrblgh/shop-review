<?php

namespace Shopreview\Validator;

/**
 * Digit range valaidtaor
 *
 * Checks if the given digit's value is in the range that was set up before. 
 * Also can check if the given value is an integer.
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
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
     * Checks if data is valid or not
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
        // integer check
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
