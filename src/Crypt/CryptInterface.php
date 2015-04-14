<?php

namespace Shopreview\Crypt;

/**
 * Interface for crypting classes
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
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
