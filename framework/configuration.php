<?php

namespace F3il;

defined("F3IL") or die("Access interdit configuration.php");

class Configuration
{

    private static $_instance;
    protected $data = array();

    /**
     * Configuration constructor.
     * @param $iniFile string $iniFile : chemin du fichier INI de configuration
     * @throws Error
     */
    private function __construct($iniFile)
    {

        if (is_readable($iniFile)) {
            if ($this->data = parse_ini_file($iniFile)) {

            } else {
                die('ce qui a été lu vaut FALSE/configuration');
            }
        } else {
            throw new \F3il\Error("le fichier $iniFile ne peut pas lire!");
        }
    }

    /**
     * Méthode de récupération de l'instance         *
     *
     * @param string $iniFile : chemin du fichier INI de configuration
     * @return Configuration
     */
    public static function getInstance($iniFile = "")
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Configuration($iniFile);
        }
        return self::$_instance;
    }

    /**
     * Getter pour les propriétés dynamiques de la configuration.
     *
     * @param string $name : nom de la propriété dynamique
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            throw new Error("$name n'existe pas dans array data");
        }
    }

    public static function isLoaded(){
        if(is_null(self::$_instance)){
            return false;
        }
        else{
            return true;
        }
    }
}
