<?php

namespace Shopreview\Validator;

use Shopreview\Helper\Session;

class CsrfValidator extends AbstractValidator
{
    /**
     * Options for validator
     *
     * @var array
     */    
    protected $options = array(
        'elementName' => 'csrf',
        'captchaData' => array(),
        'message' => 'Invalid CSRF token.'
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
     * Generate random secure one-time CSRF token
     *
     * If SHA512 is available, it is used, otherwise a 512 bit random string 
     * in the same format is generated. Stores the generated token under a 
     * unique name in session variable
     * 
     * @param string $elementName input elment's name that holds the token
     * @throws Exception if element name is a proper HTML name
     * @return string the generated CSRF token
     */
    public function generateToken()
    {
        $elementName = $this->getOption('elementName');        

        $pattern = '/^[a-zA-Z][a-zA-Z0-9_]*$/';

        if (!preg_match($pattern, $elementName)) {
            throw new Exception("Not allowed name.");
        }

        if (function_exists('hash_algos') 
            && in_array('sha512', hash_algos())
        ) {
            $token = hash('sha512', mt_rand(0, mt_getrandmax()));
        } else {
            $token = ' ';

            for ($i = 0; $i < 128; ++$i) {
                $r = mt_rand(0, 35);
                if ($r < 26) {
                    $c = chr(ord('a') + $r);
                } else { 
                    $c = chr(ord('0')+ $r - 26);
                }
                $token .= $c;
            }
        }
        
        Session::getInstance()->$elementName = $token;

        return $token;
    }

    /**
     * Checks the token for the element
     *
     * Also removes (always) the token from session (ensure one-timeness)
     * 
     * @param  $tokenValue the CSRF token
     * @return boolean
     */
    public function isValid($tokenValue)
    {
        $elementName = $this->getOption('elementName');
        
        $token = Session::getInstance()->$elementName;

        if ($token === false) {
            
            $result = false;
        } elseif ($token === $tokenValue) {
            $result = true;
        } else { 
            $result = false;
        }
        
        Session::getInstance()->$elementName = null;
        
        return $result;
    }
}
