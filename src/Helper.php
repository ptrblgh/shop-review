<?php

namespace Shopreview;

/**
 * A simple class for holding helper static functions
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class Helper
{
    /**
    * Check register globals and remove them
    *
    * @static
    * @return void
    */
    public static function unregisterGlobals() {
        if (ini_get('register_globals')) {
            $array = array(
                '_SESSION', 
                '_POST', 
                '_GET', 
                '_COOKIE', 
                '_REQUEST', 
                '_SERVER', 
                '_ENV', 
                '_FILES'
            );
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }  
    
    /** 
    * Check for Magic Quotes and remove them 
    *
    * @static
    * @return mixed
    */
    public static function stripSlashesDeep($value) {
        $value = is_array($value) 
            ? array_map(self::stripSlashesDeep, $value) 
            : stripslashes($value);
        
        return $value;
    }
    
    /**
    * Check for Magic Quotes and remove them
    *
    * @static
    * @return void
    */
    public static function removeMagicQuotes() {
        if (get_magic_quotes_gpc() ) {
            if(isset($_GET)){
                $_GET = self::stripSlashesDeep($_GET);
            }
            
            if(isset($_POST)){
                $_POST = self::stripSlashesDeep($_POST);
            }
            
            if(isset($_COOKIE)){
                $_COOKIE = self::stripSlashesDeep($_COOKIE);
            }
            
        }
    }

    /**
    * Sanitize user input
    *
    * @static
    * @param mixed $input
    * @return mixed
    */
    public static function sanitizeInput($input)
    {
        $search = array(
            '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );

        if (is_array($input)) {
            foreach ($input as $key => $val) {
                $val = preg_replace($search, '', $val);

                if (get_magic_quotes_gpc()) {
                    $val = stripslashes($val);
                }

                $input[$key] = $val;
            }

        } else {
            $input = preg_replace($search, '', $input);
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
        }

        return $input;
    }

    /**
     * Generates random character string
     * 
     * @static
     * @param  integer $length length of the returned string
     * @return string
     */
    public static function getRandomString($length = 8) 
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567
            89!@#$%^&*()_-=+;:,.?";
        $string = substr(str_shuffle($chars), 0, $length);
        
        return $string;
    }
}
