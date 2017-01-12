<?php

namespace F3il;

defined('F3IL') or die('Acces Interdit');

class Page
{

    protected $templateFile;
    protected $viewFile;
    protected $data = array();
    private static $_instance;
    protected $pageTitle;
    protected $viewHTML;
    protected $cssFiles= array();
    /**
     * Constructeur
     *
     */
    private function __construct()
    {
    }

    /**
     * Méthode de récupération de l'instance de Page
     *
     * @return Page
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Page();
        }
        return self::$_instance;
    }

    /**
     * Précise le template à utiliser
     *
     * @param string $templateName : racine du nom du template à utiliser
     * @return $this
     */
    public function setTemplate($templateFile)
    {
        if (is_readable(APPLICATION_PATH . '\templates\\' . $templateFile . '.template.php')) {
            $this->templateFile = APPLICATION_PATH . '\templates\\' . $templateFile . '.template.php';
        } else {
            throw new Error('templateFile erreur:' . APPLICATION_PATH . '\templates\\' . $templateFile . '.template.php');
        }
    }

    /**
     * Précise la vue à utiliser
     *
     * @param string $viewName : racine du nom de la vue à utiliser
     * @return $this
     */
    public function setView($viewFile)
    {
        if (is_readable(APPLICATION_PATH . '\views\\' . $viewFile . '.view.php')) {
            $this->viewFile = APPLICATION_PATH . '\views\\' . $viewFile . '.view.php';
        } else {
            throw new Error('viewFile erreur:' . APPLICATION_PATH . '\views\\' . $viewFile . '.view.php');
        }
    }

    /**
     * Permet d'insérer la vue dans le template
     */
    private function insertView()
    {
        //require $this->viewFile;
        echo $this->viewHTML;
    }

    /**
     * Effectue le rendu du template et de la vue
     *
     */
    public function rendre()
    {
        if (isset($this->templateFile) && isset($this->viewFile)) {
            ob_start();
            require $this->viewFile;
            $this->viewHTML=preg_replace_callback('/\[%\w+\%]/is', array($this,'renderCallback'), ob_get_clean());
            ob_start();
            require $this->templateFile;
            $html=ob_get_clean();
            echo preg_replace_callback('/\[%\w+\%]/is', array($this,'renderCallback'), $html);

        }
    }

    /**
     * Getter pour les propriétés dynamiques de Page
     *
     * @param string $name : nom de la propriété dynamique
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
        throw new Error("$name n'existe pas dans array data");
    }

    /**
     * Setter pour les propriétés dynamiques de Page
     *
     * @param string $name : nom de la propriété dynamique
     * @param mixed $value : valeur de la propriété dynamique
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Méthode permettant d'appeler la fonction isset() sur les prorpriétés dynamiques
     *
     * @param string $name : nom de la propriété dynamique
     * @return boolean
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * Methode permettant variable de pageTitle
     * @param $pageTitle
     */
    public function setPageTitle($pageTitle){
        $this->pageTitle=$pageTitle;
    }

    /**
     * return le variable pageTitle
     *
     * @return mixed
     */
    public function getPageTitle(){
        return $this->pageTitle;
    }

    public function addStyleSheet($cssFile){
        if(!is_readable($cssFile)){
            throw new Error("Le ficher CSS:$cssFile ne peut pas ouvre.");
        }
        if(in_array($cssFile,$this->cssFiles)){
            return ;
        }
        else{
            $this->cssFiles[]=$cssFile;
        }
    }

    public function insertStyleSheets(){
        ob_start();
        foreach($this->cssFiles as $css){
            echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"$css\" >";
        }
        return ob_get_clean();
    }

    function renderCallback($matches){
        switch($matches[0]){
            case '[%VIEW%]': return $this->viewHTML;
            case '[%STYLESHEETS%]': return $this->insertStyleSheets();
            case '[%TITLE%]' : return $this->insertPageTitle();
            case '[%MESSAGES%]': return Messages::render();
            default:
                return '';
        }
    }

    function insertPageTitle(){
        return "<title>$this->pageTitle</title>";
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

