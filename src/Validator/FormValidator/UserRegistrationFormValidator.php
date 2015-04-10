<?php

namespace Shopreview\Validator\FormValidator;

use Shopreview\Mvc\Model\UserDbRepository;

class UserRegistrationFormValidator extends FormValidator
{
    /**
     * @var UserDbRepository
     */
    protected $userDbRepository;

    /**
     * {inheritdoc}
     * @param UserDbRepository|null $userDbRepository 
     */
    public function __construct(
        array $elements, 
        $required = array(),
        UserDbRepository $userDbRepository = null
    ) {
        parent::__construct($elements, $required);

        $this->userDbRepository = $userDbRepository;

        $this->usernameLength($this->elements['register_username']);
        $this->usernameIsTaken($this->elements['register_username']);
        $this->equalPasswords(
            $this->elements['register_psw'],
            $this->elements['register_psw2']
        );
        $this->emailIsTaken($this->elements['register_email']);
        $this->checkCaptcha(
            'register_captcha', 
            $this->elements['register_captcha']
        );
    }

    /**
     * Checks username length
     * 
     * @param string $data
     * @return booelan
     */
    public function usernameLength($data)
    {
        if (strlen($data) < 3 || strlen($data) > 20) {
            $this->errors[] = 'Username length needs to be between 3 and 20.';

            return false;
        }

        return true;
    }

    /**
     * Checks username existance in database
     * 
     * @param string $data
     * @return booelan
     */
    public function usernameIsTaken($data)
    {
        if (!$this->userDbRepository) {
            
            return false;
        }

        $taken = $this->userDbRepository->findUsername($data);

        if ($taken) {
            $this->errors[] = 'Username is taken.';

            return false;
        }

        return true;
    }

    /**
     * Checks if passwords are equal
     * 
     * @param string $psw1
     * @param string $psw2
     * @return booelan
     */
    public function equalPasswords($psw1, $psw2)
    {
        if ($psw1 !== $psw2) {
            $this->errors[] = 'Passwords are not match.';

            return false;
        }

        return true;
    }

    /**
     * Checks email existance in database
     * 
     * @param string $data
     * @return booelan
     */
    public function emailIsTaken($data)
    {
        if (!$this->userDbRepository) {
            
            return false;
        }

        $taken = $this->userDbRepository->findEmail($data);

        if ($taken) {
            $this->errors[] = 'This email is already registered.';

            return false;
        }

        return true;
    }

    /**
     * Checks captcha (anti-bot)
     *
     * @param string $elementName input elment's name that holds the sum
     * @param string $sum
     * @return booelan
     */
    public function checkCaptcha($elementName, $sum)
    {
        $captcha = new CaptchaValidator();
        $valid = $captcha->checkCaptcha($elementName, $sum);

        if (!$captcha->isValid()) {
            $this->errors[] = 'Wrong sum for catpcha numbers.';

            return false;            
        }

        return true;
    }
}
