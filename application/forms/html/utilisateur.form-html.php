<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 26/12/2016
 * Time: 02:03
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');
?>
<form id="utilisateur-creer" method="POST" action="<?php $this->getAction(); ?>" class="form-horizontal">
<!--    <div class="form-group">-->
<!--        <label for="id" class="col-sm-2 control-label">--><?php //$this->fName('id');
//            $this->fLabel('id') ?><!--: </label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control" id="id" name="id" placeholder="Id">-->
<!--            --><?php //$this->fMessages('id');?>
<!--        </div>-->
<!--    </div>-->
    <?php CsrfHelper::csrf();?>
    <?php FormHelper::input($this,"id","hidden")?>
<!--    <div class="form-group">-->
<!--        <label for="nom" class="col-sm-2 control-label">--><?php //$this->fName('nom');
//            $this->fLabel('nom') ?><!--: </label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">-->
<!--            --><?php //$this->fMessages('nom');?>
<!--        </div>-->
<!--    </div>-->
    <?php FormHelper::input($this,"nom","text")?>
<!--    <div class="form-group">-->
<!--        <label for="prenom" class="col-sm-2 control-label">--><?php //$this->fName('prenom');
//            $this->fLabel('prenom') ?><!--: </label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Preom">-->
<!--            --><?php //$this->fMessages('prenom');?>
<!--        </div>-->
<!--    </div>-->
    <?php FormHelper::input($this,"prenom","text")?>
<!--    <div class="form-group">-->
<!--        <label for="email" class="col-sm-2 control-label">--><?php //$this->fName('email');
//            $this->fLabel('email') ?><!--: </label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control" id="email" name="email" placeholder="Email">-->
<!--            --><?php //$this->fMessages('email');?>
<!--        </div>-->
<!--    </div>-->
    <?php FormHelper::input($this,"email","text")?>
<!--    <div class="form-group">-->
<!--        <label for="login" class="col-sm-2 control-label">--><?php //$this->fName('login');
//            $this->fLabel('login') ?><!-- : </label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control" id="login" name="login" placeholder="Login">-->
<!--            --><?php //$this->fMessages('login'); ?>
<!--        </div>-->
<!--    </div>-->
    <?php FormHelper::input($this,"login","text")?>
<!--    <div class="form-group">-->
<!--        <label for="motdepasse" class="col-sm-2 control-label">--><?php //$this->fName('motdepasse');
//            $this->fLabel('motdepasse') ?><!--: </label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control" id="motdepasse" name="motdepasse" placeholder="Motdepasse">-->
<!--            --><?php //$this->fMessages('motdepasse');?>
<!--        </div>-->
<!--    </div>-->
    <?php FormHelper::input($this,"motdepasse","password")?>
<!--    <div class="form-group">-->
<!--        <label for="confirmation" class="col-sm-2 control-label">--><?php //$this->fName('confirmation');
//            $this->fLabel('confirmation') ?><!--: </label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control" id="confirmation" name="confirmation" placeholder="Confirmation">-->
<!--            --><?php //$this->fMessages('confirmation');?>
<!--        </div>-->
<!--    </div>-->
    <?php FormHelper::input($this,"confirmation","password")?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>