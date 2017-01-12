<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 05/01/2017
 * Time: 20:02
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');

class DiffusionController extends \F3il\Controller
{
    public function __construct($actionName = 'lister')
    {
        $this->redirectIfUnauthenticated('?controller=index');
        $this->setDefaultActionName($actionName);
    }

    public function listerAction()
    {
        $page=\F3il\Page::getInstance();
        $page->setTemplate('application');
        $page->setView('diffusion-liste');

    }

}