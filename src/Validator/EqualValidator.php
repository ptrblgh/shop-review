<?php

namespace Shopreview\Validator;

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
     * @param $data
     * @throws \Exception if invalid array given (see exception message)
     * @return boolean
     */
    public function isValid($data)
    {
        if (!is_array($data) || !isset($data[0]) || !isset($data[1])) {

            throw new \Exception('Wrong array given (array\'s first and second item needed.)');
            
        } elseif(count($data) != 2) {

            return false;
        } elseif ($data[0] == $data[1]) {

            return true;
        } else {

            return false;
        }
    }
}
