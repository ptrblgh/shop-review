<?php

namespace Shopreview\Validator;

use Shopreview\Db\DbAdapterInterface;

/**
 * Value existing check validator
 *
 * Checks if the given value exists in database.
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class ValueTakenValidator extends AbstractValidator
{
    /**
     * Options for validator
     *
     * @var array
     */    
    protected $options = array(
        'repository' => '',
        'method' => '',
        'message' => 'Value is taken.'
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
     * Checks value existance in database
     * 
     * @param string $data
     * @return booelan
     */
    public function isValid($data)
    {
        $method = $this->getOption('method');

        $taken = call_user_func_array(
            array($this->repository, $method), 
            array($data)
        );

        if ($taken) {

            return false;
        }

        return true;
    }
}
