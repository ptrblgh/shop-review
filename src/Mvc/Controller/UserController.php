<?php

namespace Shopreview\Mvc\Controller;

use Shopreview\Helper\Helper;
use Shopreview\Helper\Crypt\BCrypt;
use ShopReview\Helper\Session;
use Shopreview\Mvc\Model\User;
use Shopreview\Mvc\Model\UserDbRepository;

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

        $res = $this->getUserRepository()->saveRegistration($data);

        if ($res) {
            Session::getInstance()->username = $data['register_username'];
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
        $data = Helper::sanitizeInput($_POST['email']);

        $newPsw = Helper::getRandomPsw();

        

        $view = new JsonTemplate($data);

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
