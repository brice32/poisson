<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 04/01/2017
 * Time: 19:34
 */
class  test{
    const SESSION_KEY = 'f3il.csrfToken';

    public static function getToken(){
        if(isset($_SESSION[self::SESSION_KEY])){
            return $_SESSION[self::SESSION_KEY];
        }
        else {
            $_SESSION[self::SESSION_KEY]=  hash('sha256', uniqid());
            return $_SESSION[self::SESSION_KEY];
        }
    }
}
?>
<h1>test <? test::getToken();?></h1>

