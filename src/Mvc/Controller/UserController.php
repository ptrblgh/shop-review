<?php

namespace Shopreview\Mvc\Controller;

use Shopreview\Helper\Helper;
use Shopreview\Helper\Message;
use Shopreview\Helper\Crypt\BCrypt;
use ShopReview\Helper\Session;
use Shopreview\Mvc\Model\User;
use Shopreview\Mvc\Model\UserDbRepository;
use Shopreview\Validator\FormValidator\UserRegistrationFormValidator;
use Shopreview\Mvc\View\JsonTemplate;

class UserController extends BaseController
{
    /**
     * Mysql database repository for review
     * 
     * @var MysqlDb
     */
    protected $userRepository;

    /**
     * Constructor for Controller
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Registration
     * 
     * @return void
     */
    public function registerAction()
    {
        $data = Helper::sanitizeInput($_POST);

        $bcrypt = new BCrypt();
        $data['crypted_psw'] = $bcrypt->crypt($data['register_psw']);

        $form = new UserRegistrationFormValidator(
            $data, 
            array(), 
            $this->getUserRepository()
        );

        if ($form->isValid()) {
            $res = $this->getUserRepository()->saveUser($data);

            if ($res) {
                Session::getInstance()->username = $data['register_username'];
            } 
        } else {
            Session::getInstance()->form_errors = $form->getErrors();
        }

        header('Location: /');
    }

    /**
     * Login
     * 
     * @return void
     */
    public function loginAction()
    {
        $data = Helper::sanitizeInput($_POST);

        $user 
            = $this->getUserRepository()->findUser($data['login_username']);
        if ($user instanceof User) {
            $bcrypt = new Bcrypt();
            $valid = $bcrypt->isValid($data['login_psw'], $user->password);
            if ($valid) {
                Session::getInstance()->username = $data['login_username'];
            }
        }

        header('Location: /');
    }

    /**
     * Logout
     * 
     * @return void
     */
    public function logoutAction()
    {
        Session::getInstance()->destroy();

        header('Location: /');
    }

    /**
     * Create new password for email
     * 
     * @return string application/json
     */
    public function forgotAction()
    {
        $data = Helper::sanitizeInput($_POST);

        $user = $this->getUserRepository()->findByEmail($data['email']);

        if ($user) {
            $newPsw = Helper::getRandomPsw();
            $bcrypt = new BCrypt();
            $user->password = $bcrypt->crypt($newPsw);

            $this->getUserRepository()->updateUserPassword($user);

            $mailConfig = $this->appConfig['mail'];
            $mail = new Message($mailConfig);
            $mail->setAddress($user->email);
            $mail->setSubject('[Shop review] New password');
            $mail->setBody(
                "Dear " . $user->username . ",\n\n"
                . "Your new password: " . $newPsw);
            $mailSent = $mail->send();
            if ($mailSent === true) {
                $jsonData['status'] = 'success';
                $jsonData['msg'] = 'A new password was sent.';
            } else {
                $jsonData['status'] = 'error';
                // $jsonData['msg'] = $mailSent;
                $jsonData['msg'] = 'Please try again later.';
            }
        } else {
            $jsonData['status'] = 'error';
            $jsonData['msg'] = 'This email is not registered.';
        }

        $view = new JsonTemplate($jsonData);

        $view->display();
    }

    /**
     * Lazy-load review database repository
     * 
     * @return MysqlDb
     */
    public function getUserRepository()
    {
        if (!$this->userRepository) {
            $dbConfig = $this->appConfig['db'];

            $this->userRepository = UserDbRepository::getInstance(
                $dbConfig['server'],
                $dbConfig['driver'],
                $dbConfig['username'],
                $dbConfig['password'],
                $dbConfig['dbname']
            );
        }

        return $this->userRepository;
    }
}
