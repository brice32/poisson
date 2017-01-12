<?php
namespace Poisson;
defined('Poisson') or die('Acces interdit');
?>
<form id="test-form" method="POST" action="<?php $this->getAction(); ?>" class="form-horizontal">
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label"><?php $this->fName('email');
            $this->fLabel('email') ?>: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
            <?php $this->fMessages('email');?>
        </div>
    </div>
    <div class="form-group">
        <label for="age" class="col-sm-2 control-label"><?php $this->fName('age');
            $this->fLabel('age') ?> : </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="age" name="age" placeholder="Age">
            <?php $this->fMessages('age'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>
