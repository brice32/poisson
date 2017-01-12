<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 05/01/2017
 * Time: 13:34
 */
namespace Poisson;
use F3il\HttpHelper;
use F3il\Messenger;
use F3il\Page;

defined('Poisson') or die('Acces interdit');

class IndexController extends \F3il\Controller{

    public function __construct($actionName = 'index')
    {
        $this->redirectIfAuthenticated('?controller=suivi&action=lister');
        $this->setDefaultActionName($actionName);
    }

    public function indexAction(){
        $page=\F3il\Page::getInstance();
        $page->setTemplate('index');
        $page->setView('index');
        $form=new LoginForm("?controller=index&action=index");
        $form->getHtmlFile();
        $page->formulaire=$form;
//        if ($message = Messenger::getMessage()) {
//            \F3il\Messages::addMessage($message, 0);
//        }
        if(!$form->isSubmitted()){
            return;
        }
        $form->loadData(INPUT_POST);

//        if(!$form->isValid()){
//            \F3il\Messenger::setMessage("Login / mot de passe incorrect");
//            if ($message = Messenger::getMessage()) {
//                \F3il\Messages::addMessage($message, 0);
//            }
//            return;
//        }
        $authentication=\F3il\Authentication::getInstance();
        if(!$authentication->login($form->login,$form->motdepasse)){
            \F3il\Messenger::setMessage("Login / mot de passe incorrect");
            if ($message = Messenger::getMessage()) {
                \F3il\Messages::addMessage($message, 2);
            }
            return;
        }
        echo "Authentification reussie";
        HttpHelper::redirect('?controller=index');
    }


}