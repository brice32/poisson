<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 06/01/2017
 * Time: 09:00
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');
?>
<form id="index-login"   action="<?php echo $this->getAction(); ?>" method="post">
    <input type="text" id="<?php echo $this->fName('login');?>" name="<?php echo $this->fName('login');?>" placeholder="Votre login" value="<?php echo $this->fValue('login');?>">
    <input type="password" id="<?php echo $this->fName('motdepasse');?>" name="<?php echo $this->fName('motdepasse');?>" placeholder="Votre mot de passe" value="<?php echo $this->fValue('motdepasse');?>">
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>


<?php CsrfHelper::csrf(); ?>