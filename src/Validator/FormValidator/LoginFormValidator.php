<?php

namespace Shopreview\Validator\FormValidator;

use Shopreview\Session;
use Shopreview\Mvc\Model\UserDbRepository;
use Shopreview\Validator\FormValidator\AbstractFormValidator;
use Shopreview\Validator;

class LoginFormValidator extends AbstractFormValidator
{
    /**
     * User database repository
     * 
     * @var object
     */
    protected $userRepository;

    /**
     * Constructor for class
     * 
     * @param UserDbRepository $userRepository
     */
    public function __construct(UserDbRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * {inheritdoc}
     */
    public function isValid($elements = array())
    {
        if (!is_array($elements) || empty($elements)) {
            
            return false;
        }

        foreach ($elements as $key => $val) {
            switch ($key) {
                case 'login_username':
                    $validator = new Validator\EmptyValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] = "Username can't be empty.";
                    }

                    $validator = new Validator\LengthValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] 
                            = 'Username needs to be between 3 and 20 characters.';
                    }

                    $options = array(
                        'repository' => $this->userRepository,
                        'method' => 'findUsername'
                    );
                    $validator = new Validator\ValueTakenValidator($options);
                    if ($validator->isValid($val)) {
                        $this->errors[] = 'Username is taken.';
                    }
                    break;

                case 'login_psw':
                    $validator = new Validator\EmptyValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] = "Username can't be empty.";
                    }

                    $validator = new Validator\LengthValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] 
                            = 'Username needs to be between 3 and 20 characters.';
                    }

                    $options = array(
                        'repository' => $this->userRepository,
                        'method' => 'findUser',
                        'username' => $elements['login_username']
                    );
                    $validator 
                        = new Validator\UserPasswordValidator($options);
                    if (!$validator->isValid($val)) {
                        $this->errors[] = $validator->getOption('message');
                    }
                    break;

                case 'login_csrf_token':
                    $validator = new Validator\CsrfValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] =  $validator->getOption('message');
                    }
                    break;

               case 'login_name':
                    $validator = new Validator\EmptyValidator();
                    if ($validator->isValid($val)) {
                        $this->errors[] = "Bots are not allowed.";
                    }
                    break;
                
                default:
                    break;
            }
        }

        if (!empty($this->errors)) {
            $this->errors = "Wrong credentials.";
        }
        
        return (empty($this->errors) ? true : false);
    }
}
