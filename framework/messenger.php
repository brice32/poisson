<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 12/12/2016
 * Time: 02:19
 */
namespace F3il;

defined('F3IL') or die('Acces Interdit messages.php');
class Messenger{
    const SESSION_KEY='f3Il.messenger';

    public static function setMessage($message){
        $_SESSION[self::SESSION_KEY]=$message;
    }

    public static function getMessage(){
        if(!isset($_SESSION[self::SESSION_KEY])){
            return false;
        }
        else{
            $message=$_SESSION[self::SESSION_KEY];
            unset($_SESSION[self::SESSION_KEY]);
            return $message;
        }
    }
}