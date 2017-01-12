<?php
namespace Poisson;

use F3il\Error;
use F3il\Messages;
use F3il\Messenger;

defined('Poisson') or die('Acces Interdit');

class UtilisateurController extends \F3il\Controller
{
    public function __construct($actionName = 'lister')
    {
        $this->redirectIfUnauthenticated('?controller=index');
        $this->setDefaultActionName($actionName);
    }


    public function listerAction()
    {
//        $conf = \F3il\Configuration::getInstance();
        $page = \F3il\Page::getInstance();
        $page->setTemplate("application");
        $page->setView("utilisateur-liste");
//        $page->titre = 'lister des utilisateurs';

        $model = new UtilisateursModel();

        $page->utilisateurs = $model->lister();

        if ($message = Messenger::getMessage()) {
            \F3il\Messages::addMessage($message, 0);
        }
//        Messages::addMessage("ici,UtilisateurController!",0);
        //$page->rendre();
    }

    public function editerAction()
    {
        $page = \F3il\Page::getInstance();
        $page->setPageTitle('Modifier utilisateur');
        $page->setTemplate("application");
        $page->setView("utilisateur-form");
        $form = new UtilisateurForm("?controller=utilisateur&action=editer");
        //"?controller=utilisateur&action=creer"
        $form->getHtmlFile();
        $id = $_POST['id'];
        $form->getField('id')->value = $id;
//        unset($_POST['id']);

//        if (!array_key_exists("motdepasse", $_POST)) {
//            $_POST["motdepasse"] = false;
//            $_POST["confirmation"] = false;
//        }
//        $page->formulaire = $form;
        $form->getField("motdepasse")->value = null;
        $form->getField("confirmation")->value = null;

        if (!$form->isSubmitted()) {
            $mode = new UtilisateursModel();
            $form->loadData($mode->lire($id));
            $form->getField("motdepasse")->value = "";
            $form->getField("confirmation")->value = "";
            $page->formulaire = $form;
        }
        else{
            $page->formulaire = $form;
            $form->loadData(INPUT_POST);
            if (!$form->isValid()) {
//                \F3il\Messages::addMessage("Le formulaire n'est pas valide", 2);
                return;
            }
            $page->formData = $form->getData();
            $mode = new UtilisateursModel();
            $mode->mettreAJour($form->getData());
            $nom = $page->formData['nom'];
            $prenom = $page->formData['prenom'];
            if(CsrfHelper::checkToken()){
                Messenger::setMessage('Données de formulaire refusées');
            }
            else{
                \F3il\Messenger::setMessage("L'utilisateur $nom $prenom a bien ete enregistre.");
            }
            \F3il\HttpHelper::redirect('?controller=utilisateur&action=lister');
        }


    }

    public function supprimerAction()
    {
        if (is_null(filter_input(INPUT_POST, 'id')) || filter_input(INPUT_POST, 'id') == false) {
            throw new Error('supprimerAction ne peut pas trouvé id dans POST');
        } else {
            $model = new UtilisateursModel();
            $model->supprimer(filter_input(INPUT_POST, 'id'));
            CsrfHelper::getToken();
            \F3il\Messenger::setMessage("Suppression effectuée");
            \F3il\HttpHelper::redirect('?controller=utilisateur&action=lister');

        }
    }

    public function creerAction()
    {
//        $_POST['id']=0;
        $page = \F3il\Page::getInstance();
        $page->setPageTitle("Nouvel utilisateur");
        $page->setTemplate("application");
        $page->setView("utilisateur-form");
        $form = new UtilisateurForm("?controller=utilisateur&action=creer");
        $form->getField('id')->value = 0;
        //"?controller=utilisateur&action=creer"
        $form->getHtmlFile();

        $page->formulaire = $form;
        if ($form->isSubmitted()) {
            $form->loadData(INPUT_POST);
            if (!$form->isValid()) {
                \F3il\Messages::addMessage("Le formulaire n'est pas valide", 2);
                return;
            }
            $page->formData = $form->getData();
            $mode = new UtilisateursModel();
            $mode->creer($form->getData());
            $nom = $page->formData['nom'];
            $prenom = $page->formData['prenom'];
            if(CsrfHelper::checkToken()){
                \F3il\Messenger::setMessage('Données de formulaire refusées');
            }
            else{
                \F3il\Messenger::setMessage("L'utilisateur $nom $prenom a bien ete enregistre.");
            }
            \F3il\HttpHelper::redirect('?controller=utilisateur&action=lister');
        }

//        if($mode->loginExistant($page->formData['login']))
    }

    public function deconnecterAction(){
        $authentication=\F3il\Authentication::getInstance();
        $authentication->logout();
        \F3il\HttpHelper::redirect('?controller=utilisateur');
    }
}
