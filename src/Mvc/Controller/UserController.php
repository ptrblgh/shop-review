<?php

namespace Shopreview\Mvc\Controller;

use Shopreview\Helper\Helper;

class UserController extends BaseController
{

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

        // TODO
        // bcrypt $data['psw']

        $this->getDbAdapter()->saveRegistration($data);

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
