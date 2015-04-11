<?php

namespace Shopreview\Mvc\Controller;

use Shopreview;
use Shopreview\Helper;
use Shopreview\Message;
use Shopreview\Crypt\Bcrypt;
use ShopReview\Session;
use Shopreview\Mvc\Model\User;
use Shopreview\Mvc\Model\UserDbRepository;
use Shopreview\Validator\LoggedInPasswordValidator;
use Shopreview\Validator\ValueTakenValidator;
use Shopreview\Validator\FormValidator\RegisterFormValidator;
use Shopreview\Validator\FormValidator\ChangePasswordFormValidator;
use Shopreview\Validator\FormValidator\LoginFormValidator;
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

        $bcrypt = new Bcrypt();
        $data['crypted_psw'] = $bcrypt->crypt($data['register_psw']);

        $validator = new RegisterFormValidator($this->getUserRepository());

        if ($validator->isValid($data)) {
            $res = $this->getUserRepository()->saveUser($data);

            if ($res) {
                Session::getInstance()->username = $data['register_username'];
            } 
        } else {
            Session::getInstance()->form_errors = $validator->getErrors();
        }

        header('Location: /', true, 302);
        exit();
    }

    /**
     * Login
     * 
     * @return void
     */
    public function loginAction()
    {
        $data = Helper::sanitizeInput($_POST);

        $validator = new LoginFormValidator($this->getUserRepository());

        if ($validator->isValid($data)) {
            Session::getInstance()->username = $data['login_username'];
        } else {
            Session::getInstance()->form_errors = $validator->getErrors();
        }

        // $options = array(
        //     'repository' => $this->getUserRepository(),
        //     'method' => 'findUser',
        //     'username' => $data['login_username']
        // );
        // $validator 
        //     = new LoggedInPasswordValidator($options);
        // if ($validator->isValid($data['login_psw'])) {
        //     Session::getInstance()->username = $data['login_username'];
        // } else {
        //     Session::getInstance()->form_errors 
        //         = $validator->getOption('message');
        // }

        header('Location: /', true, 302);
        exit();
    }

    /**
     * Logout
     * 
     * @return void
     */
    public function logoutAction()
    {
        Session::getInstance()->destroy();

        header('Location: /', true, 302);
        exit();
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
                'Dear ' . $user->username . ',\n\n'
                . 'Your new password: ' . $newPsw);
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
     * Check username availability
     * 
     * @return string false or true
     */
    public function checkUsernameAction()
    {
        $data = Helper::sanitizeInput($_POST['register_username']);

        $options = array(
            'repository' => $this->getUserRepository(),
            'method' => 'findUsername'
        );
        try {
            $validator = new ValueTakenValidator($options);   
            
            $ret = $validator->isValid($data);

            $jsonData = ($ret === false) ? 'Username is taken.' : true;

            $view = new JsonTemplate($jsonData);

            $view->display();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Check email availability
     * 
     * @return string false or true
     */
    public function checkEmailAction()
    {
        $data = Helper::sanitizeInput($_POST['register_email']);

        $options = array(
            'repository' => $this->getUserRepository(),
            'method' => 'findEmail'
        );
        try {
            $validator = new ValueTakenValidator($options);   
            
            $ret = $validator->isValid($data);

            $jsonData = ($ret === false) ? 'Email is already registered.' : true;

            $view = new JsonTemplate($jsonData);

            $view->display();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Change password
     * 
     * @return void
     */
    public function changePasswordAction()
    {
        $data = Helper::sanitizeInput($_POST);

        $form = 
            new ChangePasswordFormValidator($this->getUserRepository());

        if ($form->isValid($data)) {
            $bcrypt = new BCrypt();
            $user = new User();
            $user->password = $bcrypt->crypt($data['change_psw_psw']);
            $user->username = Session::getInstance()->username;
            $ret = $this->getUserRepository()->updateUserPassword($user);
            if ($ret) {
                $message = 'Password has changed.';
                Session::getInstance()->form_errors = $message;

                return $this->logoutAction();
            }
        } else {
            Session::getInstance()->form_errors = $form->getErrors();
        }

        header('Location: /', true, 302);
        exit();
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
