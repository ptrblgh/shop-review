<?php

namespace Shopreview\Validator;

use Shopreview\Helper\Session;

class CaptchaValidator implements ValidatorInterface
{
    protected $result = false;

    /**
     * Generate two random 0-10 numbers and their sum
     * 
     * @param string $elementName input elment's name that holds the token
     * @throws Exception if element name is a proper HTML name
     * @return array the numbers to add and their sum
     */
    public function generateCaptcha($elementName)
    {   
        $pattern = '/^[a-zA-Z][a-zA-Z0-9_]*$/';

        if (!preg_match($pattern, $elementName)) {
            throw new Exception("Not allowed name.");
        }

        $num1 = mt_rand(0, 10);
        $num2 = mt_rand(0, 10);
        $sum = $num1 + $num2;

        $captchaArr = array('num1' => $num1, 'num2' => $num2, 'sum' => $sum);

        Session::getInstance()->$elementName = $captchaArr;

        return $captchaArr;
    }

    /**
     * Checks the token for the element
     *
     * Also removes (always) the token from session (ensure one-timeness)
     * 
     * @param string $elementName input elment's name that holds the token
     * @param  $tokenValue the CSRF token
     * @return boolean
     */
    function checkCaptcha($elementName, $captchaValue)
    {
        $captchaArr = Session::getInstance()->$elementName;

        if (!is_array($captchaArr)
            || !array_key_exists('num1', $captchaArr)
            || !array_key_exists('num2', $captchaArr)
            || !array_key_exists('sum', $captchaArr)
        ) {
            $this->result = false;

            return false;
        } elseif ($captchaArr['sum'] === (int) $captchaValue) {
            $result = true;
        } else { 
            $result = false;
        }
        
        Session::getInstance()->$elementName = null;
        $this->result = $result;
        
        return $result;
    }

    /**
     * {inheritdoc}
     */
    function isValid()
    {
        return $this->result;
    }
}
