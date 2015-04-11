<?php

namespace Shopreview\Validator;

use Shopreview\Helper\Db\DbAdapterInterface;

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
     * @throws \Exception if repository is not instance of UserDbRepository
     * @return void
     */
    public function __construct($options = array())
    {
        parent::__construct($options);
    }

    /**
     * Checks username existance in database
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
