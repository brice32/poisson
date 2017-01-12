<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 04/01/2017
 * Time: 18:56
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');

class CsrfHelper{
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

    public static function csrf(){
        $cle=self::getToken();
        ?>
        <input type="hidden" name="<?php echo $cle; ?>" value="0" />
        <?php
    }

    public static function checkToken(){
        if(isset($_SESSION[self::SESSION_KEY])){
            if(filter_input(INPUT_POST,$_SESSION[self::SESSION_KEY]==='0')){
                return true;
            }else{
                return false;
            }
        }
        else{
            return false;
        }

    }
}