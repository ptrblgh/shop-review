<?php

namespace Shopreview\Validator;

/**
 * Requirement check for elements
 *
 * Checks if the given value is set, not empty
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
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
