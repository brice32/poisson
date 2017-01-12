<?php

namespace F3il;

defined("F3IL") or die("Acess interdit framework/application/php");

class Application
{
    private static $_instance;
    protected $controllerName;
    protected $actionName;
    protected $defaultControllerName;

    /**
     * Constructeur
     *
     * @param string $iniFile : chemin du fichier INI de confuration
     */
    private function __construct($iniFile)
    {
        Configuration::getInstance($iniFile);
        //APPLICATION_PATH.'\configuration.ini' remplace cette address de ficher par $iniFile
    }

    /**
     * Retourne l'instance de Application
     *
     * @param string $iniFile : chemin du fichier INI de configuration
     * @return Application
     */
    public static function getInstance($iniFile = "")
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Application($iniFile);
        }
        return self::$_instance;
    }

    /**
     * Méthode principale d'exécution de l'application Web
     * - Analyse l'URL de la requête
     * - Route la requête vers l'action de contrôleur demandéé
     * - Affiche la page.
     */
    public function run()
    {
        $this->controllerName = filter_input(INPUT_GET, 'controller');
        //require_once APPLICATION_PATH . '\controllers\\' . $this->controllerName . '.controller.php';
        if(!filter_has_var(INPUT_GET, 'controller'))
        {
            $this->controllerName=$this->defaultControllerName;
        }
        else if(!is_readable(APPLICATION_PATH.'\\controllers\\'.$this->controllerName.'.controller.php')){
            throw new \F3il\Error("Methode $this->controllerName ne peut pas trouvé!");
        }
        $this->setDefaultControllerName($this->controllerName);
        $this->actionName = filter_input(INPUT_GET, 'action');
        $controllerClass = "\\" . APPLICATION_NAMESPACE . "\\" . ucfirst($this->defaultControllerName) . 'Controller';
        $controller = new $controllerClass;
        $this->actionName = filter_input(INPUT_GET, 'action');
        if(!filter_has_var(INPUT_GET, 'action'))
        {
            $this->actionName=$controller->getDefaultActionName();
        }
        $actionMethod = $this->actionName . 'Action';

        if(!method_exists($controller, $actionMethod)){
            throw new \F3il\ControllerError("methode ou action ne marche pas",$this->controllerName, $this->actionName);
        }
        $controller->$actionMethod();
        $page = Page::getInstance();
        $page->rendre();
    }

    /**
     * Getter pour récupérer l'instance de la Page
     * Equivalent à Page::getInstance()
     *
     * @return Page
     */
    public function getPage()
    {
        return Page::getInstance();
    }

    /**
     * Getter pour récupérer l'instance de la Configuration
     * Equivalent à Configuration::getInstance()
     *
     * @return Configuration
     */
    public function getConfiguration()
    {
        return Configuration::getInstance();
    }

    public function setDefaultControllerName($controllerName){

            $this->defaultControllerName=$controllerName;

    }

    public function getControllerName(){
        return $this->controllerName;
    }

    public function getActionName(){
        return $this->actionName;
    }

    public function getCurrentLocation(){
        $location = array();
        $location['controller']=$this->getControllerName();
        $location['action']=$this->getActionName();
        return $location;
    }

    public function setAuthenticationDelegate($className){
        $className='\Poisson\\'.$className;
        $mode=new $className();
        Authentication::getInstance($mode);
    }
}
