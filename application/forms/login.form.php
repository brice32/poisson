<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 06/01/2017
 * Time: 09:26
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');
class LoginForm extends \F3il\Form

{

    public function __construct($action)
    {
        parent::__construct($action, 'index-login');
        $this->addFormField(new \F3il\Field('login', 'Login', null, true));
        $this->addFormField(new \F3il\Field('motdepasse', 'Motdepasse', null, true));

    }
    public function motdepasseValidator($motdepasse)
    {
        if (strlen($motdepasse) >= 4) {
            return true;
        } else {
            $this->addMessage('motdepasse', "Motdepasse doit Longueur >=4");
            return false;
        }
    }

}