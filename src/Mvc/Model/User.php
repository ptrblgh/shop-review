<?php

namespace Shopreview\Mvc\Model;

class User
{
    public $username;
    public $password;
    public $email;

    /**
     * Retriving entity properties
     * 
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
