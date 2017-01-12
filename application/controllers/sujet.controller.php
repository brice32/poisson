<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 05/01/2017
 * Time: 14:50
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');

class SujetController extends \F3il\Controller
{
    public function __construct($actionName = 'lister')
    {
        $this->redirectIfUnauthenticated('?controller=index');
        $this->setDefaultActionName($actionName);
    }


public function listerAction(){
    $page=\F3il\Page::getInstance();
    $page->setTemplate('application');
    $page->setView('sujet-liste');
}

}
