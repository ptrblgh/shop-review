<?php

namespace Shopreview\Helper\Crypt;

interface CryptInterface
{
    /**
     * Crypt string with bcrypt
     *
     * @param string $string string to crypt
     * @return string|void hash
     */
    public function crypt($string);

    /**
     * Verifying string if its valid or not
     * 
     * @param string $string string to check against hash
     * @param string $hash hash
     * @return boolean
     */
    public function isValid($string, $hash);
}
