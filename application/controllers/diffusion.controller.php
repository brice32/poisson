<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 05/01/2017
 * Time: 20:02
 */
namespace Poisson;
use F3il\HttpHelper;

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
        $mode_news= new NewsModel();
        $page->news=$mode_news->lister();
        $mode_diffusion= new DiffusionModel();
        $page->diffusion= $mode_diffusion->lister();
    }

    public function ajouterAction()
    {
        $id = $_POST['id'];
        $mode_diffusion= new DiffusionModel();
        $ordre_maximale=$mode_diffusion->ordremaxi();
        $mode_diffusion->ajouter($id,$ordre_maximale+1);
        HttpHelper::redirect('?controller=diffusion');
    }

    public function supprimerAction(){
        $ordre= $_GET['ordre'];
        $mode_diffusion= new DiffusionModel();
        $mode_diffusion->supprimerorder($ordre);
        HttpHelper::redirect('?controller=diffusion');
    }

    public function touteffacerAction(){
        $mode_diffusion= new DiffusionModel();
        $mode_diffusion->touteffacer();
        HttpHelper::redirect('?controller=diffusion');
    }

    public function setordreAction(){
        $ordre=$_GET['ordre'];
        $_SESSION['ordre']=$ordre;
        HttpHelper::redirect('?controller=diffusion');
    }

}