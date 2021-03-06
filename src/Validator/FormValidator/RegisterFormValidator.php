<?php

namespace Shopreview\Validator\FormValidator;

use Shopreview\Mvc\Model\UserDbRepository;
use Shopreview\Validator\FormValidator\AbstractFormValidator;
use Shopreview\Validator;

/**
 * Validators for registration form
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class RegisterFormValidator extends AbstractFormValidator
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
     * @return void
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
                case 'register_username':
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
                    if (!$validator->isValid($val)) {
                        $this->errors[] = 'Username is taken.';
                    }
                    break;

                case 'register_psw':
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

                case 'register_psw2':
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
                        $elements['register_psw'], 
                        $elements['register_psw2']
                    );
                    $validator = new Validator\EqualValidator($options);
                    if (!$validator->isValid($passwords)) {
                        $this->errors[] = $validator->getOption('message');
                    }
                    break;

                case 'register_email':
                    $validator = new Validator\EmptyValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] = "E-mail can't be empty.";
                    }

                    if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                        $this->errors[] = 'Invalid e-mail address.';
                    }

                    $options = array(
                        'repository' => $this->userRepository,
                        'method' => 'findEmail'
                    );
                    $validator = new Validator\ValueTakenValidator($options);
                    if (!$validator->isValid($val)) {
                        $this->errors[] = 'Email is already registered.';
                    }
                    break;

                case 'register_captcha':
                    $validator = new Validator\EmptyValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] = "The sum can't be empty.";
                    }

                    $validator = new Validator\CaptchaValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] =  $validator->getOption('message');
                    }
                    break;

                case 'register_csrf_token':
                    $validator = new Validator\CsrfValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] =  $validator->getOption('message');
                    }
                    break;

               case 'register_name':
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

    /**
     * Getter for error messages
     * 
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
