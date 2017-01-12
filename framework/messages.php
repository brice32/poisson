<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 07/12/2016
 * Time: 15:22
 */
namespace F3il;

defined('F3IL') or die('Acces Interdit messages.php');



class Messages{

    const MESSAGE_SUCCESS=0;
    const MESSAGE_WARNING=1;
    const MESSAGE_ERROR=2;

    private static $_messages=array();
    private static $_renderer='\F3il\Messages::defaultRenderer';

    public static function addMessage($message,$type){
        if($type!=self::MESSAGE_SUCCESS&&$type!=self::MESSAGE_WARNING&&$type!=self::MESSAGE_ERROR){
            throw new Error('Si la valeur de type n\'est pas parmi les 3 constantes déclencher une Error pour type de message inconnu.');
        }
        self::$_messages[]= array( 'message'=> $message, 'type'=> $type);
    }

    public static function getMessageCount(){
        return count(self::$_messages);
    }

    public static function getMessage($num=0){
        if(isset(self::$_messages[$num])){
            return self::$_messages[$num];
        }else{
            throw new Error("N'a pas message[$num] d'existant!");
        }
    }

    public static function setMessageRenderer($renderer){
        self::$_renderer=$renderer;
    }

    /**
     *  La fonction call_user_func() permet d'appeler une fonction/méthode contenue dans une chaîne.
     *  Faire self::$_renderer() ne fonctionne pas pour différentes raisons, je n'irai pas plus loin dans les explications
     * @return string
     */
    public static function render(){
        ob_start();
        call_user_func(self::$_renderer);
        return ob_get_clean();
    }

    public static function defaultRenderer(){
//        self::addMessage("lalala",1);
//        self::addMessage("blabla",0);
//        ob_start();
        echo '<div>';
        foreach (self::$_messages as $message){
            echo "<p>$message</p>";
        }
        echo '</div>';
    }

}