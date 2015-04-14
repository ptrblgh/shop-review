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

/**
 * Controller for user-related actions
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class UserController extends BaseController
{
    /**
     * Mysql database repository for user
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

        // add the crypted password to the form data array
        $bcrypt = new Bcrypt();
        $data['crypted_psw'] = $bcrypt->crypt($data['register_psw']);

        $validator = new RegisterFormValidator($this->getUserRepository());

        if ($validator->isValid($data)) {
            $res = $this->getUserRepository()->saveUser($data);

            // after successfull registration we log in the registered user
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
     * Create new password for email and sends it to the e-mail
     * 
     * @return string application/json
     */
    public function forgotAction()
    {
        $data = Helper::sanitizeInput($_POST);

        $user = $this->getUserRepository()->findByEmail($data['email']);

        if ($user) {
            // create the new password
            $newPsw = Helper::getRandomString();
            $bcrypt = new BCrypt();
            $user->password = $bcrypt->crypt($newPsw);

            // sets the generated, bcrypted password
            $this->getUserRepository()->updateUserPassword($user);

            // constructing the mail object
            $mailConfig = $this->appConfig['mail'];
            try {
                $mail = new Message($mailConfig);
            } catch (\Exception $e) {
                exit($e->getMessage());
            }
            $mail->setAddress($user->email);
            $mail->setSubject('[Shop review] New password');
            $mail->setBody(
                'Dear ' . $user->username . ',\n\n'
                . 'Your new password: ' . $newPsw);
            $mailSent = $mail->send();
            if ($mailSent === true) {
                // password change process ends, inform the user
                $jsonData['status'] = 'success';
                $jsonData['msg'] = 'A new password was sent.';
            } else {
                $jsonData['status'] = 'error';
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

            // return information for the javascript
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

            // return information for the javascript
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
            // create new bcrypted password for the user
            $bcrypt = new BCrypt();
            $user = new User();
            $user->password = $bcrypt->crypt($data['change_psw_psw']);
            $user->username = Session::getInstance()->username;
            $ret = $this->getUserRepository()->updateUserPassword($user);
            if ($ret) {
                $message = 'Password has changed.';
                Session::getInstance()->form_errors = $message;

                // if everything went good we log out the user too
                return $this->logoutAction();
            }
        } else {
            Session::getInstance()->form_errors = $form->getErrors();
        }

        header('Location: /', true, 302);
        exit();
    }

    /**
     * Lazy-load user database repository
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
