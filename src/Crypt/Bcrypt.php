<?php

namespace Shopreview\Crypt;

/**
 * Bcrypt wrapper class
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class Bcrypt implements CryptInterface
{
    /**
     * @var integer
     */
    protected $cost = 8;

    /**
     * Setter for cost
     * 
     * @param int $string
     * @return void
     */
    public function setCost($cost)
    {
        $this->cost = (int) $cost;
    }

    /**
     * {inheritdoc}
     */
    public function crypt($string)
    {
        if (strlen($string) >= 6 && strlen($string) <= 72) {
            return password_hash(
                $string, 
                PASSWORD_BCRYPT, 
                array('cost' => $this->cost)
            );
        }
    }

    /**
     * {inheritdoc}
     */
    public function isValid($string, $hash)
    {
        return password_verify($string, $hash);
    }
}
