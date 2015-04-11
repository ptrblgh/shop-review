<?php

namespace Shopreview\Validator;

use Shopreview\Helper\Db\DbAdapterInterface;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * Options for validator
     *
     * @var array
     */    
    protected $options = array(
        'message' => 'Invalid data was given.'
    );
    
    /**
     * @var UserDbRepository
     */
    protected $repository;

    /**
     * Constructor for validator
     * 
     * @param  string $data
     * @return boolean
     */
    public function __construct($options = array())
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }

        if (array_key_exists('repository', $options)) {
            $repository = $this->getOption('repository');

            $method = $this->getOption('method');

            if (!($repository instanceof DbAdapterInterface)
                || !method_exists($repository, $method)
            ) {
                $message = "Repository is not instance of DbAdapterInterface or"
                    . " '$method' is not exists in $repository";
                throw new \Exception($message);
            }

            $this->repository = $repository;
        }
    }

    /**
     * Set options
     * 
     * @param array $options
     */
    public function setOptions($options = array())
    {
        foreach ($options as $name => $option) {
            if (isset($this->options)) {
                $this->options[$name] = $option;
            }
        }

        return $this;
    }

    /**
     * Get an option
     * 
     * @param  $option option array key
     * @throws \Exception if option not in array
     * @return mixed|\Exception
     */
    public function getOption($option)
    {
        if (isset($this->options) 
            && array_key_exists($option, $this->options)
        ) {
            return $this->options[$option];
        }

        throw new \Exception("Invalid option '$option'");
    }
}
