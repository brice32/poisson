<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 12/12/2016
 * Time: 05:59
 */
namespace F3il;


defined("F3IL") or die("Access interdit field.php");

class Field{
    public $name;
    public $label;
    public $required;
    public $value;
    public $defaultValue;
    protected $messages=array();


    public function __construct($name,$label,$defaultValue=null,$required=false){
        $this->name=$name;
        $this->label=$label;
        $this->defaultValue=$defaultValue;
        $this->required=$required;
    }

    public function addMessage($message){
        $this->messages[]=$message;
    }

    public function getMessages(){
        return $this->messages;
    }


}