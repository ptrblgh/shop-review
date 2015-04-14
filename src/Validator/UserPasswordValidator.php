<?php

namespace Shopreview\Validator;

use Shopreview\Session;
use Shopreview\Crypt\Bcrypt;
use Shopreview\Mvc\Model\User;

/**
 * User password validation
 *
 * Checks if the given password string belongs to the given username
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class UserPasswordValidator extends AbstractValidator
{
    /**
     * Options for validator
     *
     * @var array
     */    
    protected $options = array(
        'username' => '',
        'message' => 'Wrong password.'
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
     * Checks if the given data is the user's password
     * 
     * @param string $data the password
     * @return boolean
     */
    public function isValid($data)
    {
        
        $username = $this->getOption('username');
        
        $user = $this->repository->findUser($username);

        if ($user instanceof User) {
            $bcrypt = new Bcrypt();
            $valid = $bcrypt->isValid($data, $user->password);
            if ($valid) {

                return true;
            }
        }

        return false;
    }
}
