<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 02/12/2016
 * Time: 21:59
 */

namespace F3il;


defined("F3IL") or die("Access interdit database.php");

abstract class Database
{

    private static $_instance;

    public static function getInstance()
    {
//        $class = get_called_class();
//        if (is_null(self::$_instance)) {
//            self::$_instance = new $class();
//        }

        if (!\F3il\Configuration::isLoaded()) {
            throw new \F3il\Error("Configuration n'a pas charge");
        }

        $conf = \F3il\Configuration::getInstance();
        try {
//            self::$_instance = new \PDO("mysql:host=$conf->mysql_host;dbname=$conf->mysql_dbname", $conf->mysql_login,$conf->mysql_password);
            self::$_instance = new \PDO('mysql:host=localhost;dbname=Poisson','root','');
//            ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
//            self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die('Erreur connexion dans database.php');
        }
        return self::$_instance;

    }


}
