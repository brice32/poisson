<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 02/12/2016
 * Time: 14:05
 */

namespace F3il;

defined("F3IL") or die("Access interdit /framework/controller.php");



abstract class Controller{

    protected $defaultActionName;

    public function setDefaultActionName($actionName){
        if(method_exists($this,$actionName."Action")){
            $this->defaultActionName=$actionName;
        }
        else{
            throw new \F3il\ControllerError("Ce action n'existe pas!","utilisateur",$actionName);
        }

    }

    public function getDefaultActionName(){
            return $this->defaultActionName;
    }

    public function redirectIfAuthenticated($redirect){
        $authentication=\F3il\Authentication::getInstance();
        if($authentication->isLoggedIn()){
            \F3il\HttpHelper::redirect($redirect);
        }
    }

    public function redirectIfUnauthenticated($redirect){
        $authentication=\F3il\Authentication::getInstance();
        if(!$authentication->isLoggedIn()){
            \F3il\HttpHelper::redirect($redirect);
        }
    }
}