<?php

namespace Shopreview\Helper;

class Helper
{
    /**
    * Check register globals and remove them
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
    */
    public static function stripSlashesDeep($value) {
        $value = is_array($value) 
            ? array_map(self::stripSlashesDeep, $value) 
            : stripslashes($value);
        
        return $value;
    }
    
    /**
    * Check for Magic Quotes and remove them
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
    */
    public static function sanitizeInput($input)
    {
        $search = array(
            '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );

        $inputArr = array();

        if (!is_array($input)) {
            $inputArr[] = $input;
        }

        foreach ($inputArr as $key => $val) {
            $val = preg_replace($search, '', $val);

            if (get_magic_quotes_gpc()) {
                $val = stripslashes($val);
            }

            $inputArr[$key] = $val;
        }

        return $inputArr;
    }
}
