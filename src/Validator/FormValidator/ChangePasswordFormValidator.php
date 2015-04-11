<?php

namespace Shopreview\Validator\FormValidator;

use Shopreview\Helper\Session;
use Shopreview\Mvc\Model\UserDbRepository;
use Shopreview\Validator\FormValidator\AbstractFormValidator;
use Shopreview\Validator;

class ChangePasswordFormValidator extends AbstractFormValidator
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
                case 'change_psw_current_psw':
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
                        'username' => Session::getInstance()->username
                    );
                    $validator 
                        = new Validator\UserPasswordValidator($options);
                    if (!$validator->isValid($val)) {
                        $this->errors[] = $validator->getOption('message');
                    }
                    break;

                case 'change_psw_psw':
                    $validator = new Validator\EmptyValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] = "Password can't be empty.";
                    }

                    $options = array(
                        'min' => 6,
                        'max' => 72
                    );
                    $validator = new Validator\LengthValidator($options);
                    if (!$validator->isValid($val)) {
                        $this->errors[] 
                            = 'Password needs to be between 6 and 72 characters.';
                    }
                    break;

                case 'change_psw_psw2':
                    $validator = new Validator\EmptyValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] = "Re-entered password can't be empty.";
                    }

                    $options = array(
                        'min' => 6,
                        'max' => 72
                    );
                    $validator = new Validator\LengthValidator($options);
                    if (!$validator->isValid($val)) {
                        $this->errors[] 
                            = 'Re-entered password needs to be between 6 and 72 characters.';
                    }

                    $passwords = array(
                        $elements['change_psw_psw'], 
                        $elements['change_psw_psw2']
                    );
                    $validator = new Validator\EqualValidator($options);
                    if (!$validator->isValid($passwords)) {
                        $this->errors[] = $validator->getOption('message');
                    }
                    break;

                case 'change_psw_csrf_token':
                    $validator = new Validator\CsrfValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] =  $validator->getOption('message');
                    }
                    break;

               case 'change_psw_name':
                    $validator = new Validator\EmptyValidator();
                    if ($validator->isValid($val)) {
                        $this->errors[] = "Bots are not allowed.";
                    }
                    break;
                
                default:
                    break;
            }
        }

        return (empty($this->errors) ? true : false);
    }
}
