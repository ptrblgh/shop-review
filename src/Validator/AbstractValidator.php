<?php

namespace Shopreview\Validator;

use Shopreview\Db\DbAdapterInterface;

/**
 * Abstract class for validators
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
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
     * @var DbAdapterInterface
     */
    protected $repository;

    /**
     * Constructor for validator
     * 
     * @param  array $data
     * @throws \Exception if repository is not an instance of DbAdapterInterface
     * @return void
     */
    public function __construct($options = array())
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }

        // repository check
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
     * @return object
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
     * @return array|\Exception
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
