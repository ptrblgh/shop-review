<?php

namespace Shopreview\Validator;

/**
 * Equality validator
 *
 * Checks if the two given value equals or not.
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class EqualValidator extends AbstractValidator
{
    /**
     * Options for validator
     *
     * @var array
     */    
    protected $options = array(
        'message' => 'Values are not equal.'
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
     * @param array $data [0] is the first and [1] is the second value
     * @throws \Exception if invalid array given (see exception message)
     * @return boolean
     */
    public function isValid($data)
    {
        if (!is_array($data) || !isset($data[0]) || !isset($data[1])) {

            throw new \Exception('Wrong array given (array\'s the first and 
                second item need to be set in the given array.)');
            
        } elseif(count($data) != 2) {

            return false;
        } elseif ($data[0] == $data[1]) {

            return true;
        } else {

            return false;
        }
    }
}
