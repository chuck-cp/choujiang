<?php
namespace common\tools;

class Cookie
{
    public static function get($key) {
        if (!isset($_SESSION[$key]) && isset($_COOKIE[$key])) {
            $_SESSION[$key]  = $_COOKIE[$key];
        }
        return $_SESSION[$key] ?? '';
    }

    public static function set($key,$value,$time = 108720,$path = '/') {
        $_SESSION[$key] = $value;
        return setcookie($key, $value,time() + $time, $path,'',false,false);
    }

    public static function del($key) {
        unset($_SESSION[$key]);
        return setcookie($key, '',-1,'/');
    }
}
