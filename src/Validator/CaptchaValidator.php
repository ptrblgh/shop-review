<?php

namespace Shopreview\Validator;

use Shopreview\Helper\Session;

class CaptchaValidator extends AbstractValidator
{
    /**
     * Options for validator
     *
     * @var array
     */    
    protected $options = array(
        'min' => 0,
        'max' => 10,
        'elementName' => 'captcha',
        'message' => 'Wrong sum for catpcha numbers.'
    );

    /**
     * Constructor for validator
     * 
     * @param array $options
     * @return void
     */
    public function __construct($options = array())
    {
        parent::__construct($options);
    }

    /**
     * Generate two random 0-10 numbers and their sum
     * 
     * @throws Exception if element name is a proper HTML name
     * @return array the numbers to add and their sum
     */
    public function generateCaptcha()
    {   
        $elementName = $this->getOption('elementName');

        $pattern = '/^[a-zA-Z][a-zA-Z0-9_]*$/';        

        if (!preg_match($pattern, $elementName)) {
            throw new Exception("Not allowed name.");
        }

        $min = $this->getOption('min');
        $max = $this->getOption('max');
        $num1 = mt_rand($min, $max);
        $num2 = mt_rand($min, $max);
        $sum = $num1 + $num2;

        $captchaArr = array('num1' => $num1, 'num2' => $num2, 'sum' => $sum);

        Session::getInstance()->$elementName = $captchaArr;

        return $captchaArr;
    }

    /**
     * Checks the token for the element
     *
     * Also removes (always) the captcha elements from session
     * 
     * @param  $captchaValue the CSRF token
     * @return boolean
     */
    public function isValid($captchaValue)
    {
        $elementName = $this->getOption('elementName');

        $captchaArr = Session::getInstance()->$elementName;

        if (!is_array($captchaArr)
            || !array_key_exists('num1', $captchaArr)
            || !array_key_exists('num2', $captchaArr)
            || !array_key_exists('sum', $captchaArr)
        ) {

            $result = false;
        } elseif ($captchaArr['sum'] === (int) $captchaValue) {
            $result = true;
        } else { 
            $result = false;
        }
        
        Session::getInstance()->$elementName = null;
        
        return $result;
    }
}
