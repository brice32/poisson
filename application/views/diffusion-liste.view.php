<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 12/01/2017
 * Time: 18:52
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');
//$this->addStyleSheet();
$this->setPageTitle('Diffusion');
$mode_diff=new DiffusionModel();
if(isset($_SESSION['ordre'])){
    $ordre_value=$_SESSION['ordre'];
}
else{
    $ordre_value=1;
}
?>
<div id='control'>

    <div style="height: 100px;width: 100%;">
        <div class="info">
            <!-- indique si la diffusion est en cours (cliquer dessus pour activer/désactiver-->
            <span id="live"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i></span>
            <p> Dernière mise à jour : <?php echo $mode_diff->update_modification()?></p>
            <!--Demander confirmation avant d'effacer (popup ?)-->
            <button  class='btn btn-primary' form="tout-effacer">Tout effacer</button>
            <div class="" style="height: 35px; float: right; width: 100px ">
                <select id="ordre" class="form-control btn btn-primary" form="select-ordre">
                    <option value="1" <?php if($ordre_value==1) echo 'selected="selected"'?>>Date décroissante</option>
                    <option value="2" <?php if($ordre_value==2) echo 'selected="selected"'?>>Date croissante</option>
                    <option value="3" <?php if($ordre_value==3) echo 'selected="selected"'?>>Rédacteur décroissant</option>
                    <option value="4" <?php if($ordre_value==4) echo 'selected="selected"'?>>Rédacteur croissant</option>
                </select>

            </div>
            <form id="tout-effacer" method="POST" action="?controller=diffusion&action=touteffacer"></form>
            <form id="select-ordre" method="POST" action="?controller=diffusion&action=setordre"></form>
        </div>

    </div>
<!--    <div style="height: 35px; width: 100%">-->
<!--        <div style="float: right">-->
<!--            <label class="control-label col-sm-1">Disponibilité</label>-->
<!--            <div class="col-sm-4">-->
<!--                <select class="form-control" id="disponibilite" name="disponibilite">-->
<!--                    <option>disponible</option>-->
<!--                    <option>indisponible</option>-->
<!--                    <option>a_confirmer</option>-->
<!--                    <option>non_renseigne</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div style="float: left">-->
<!--            <label class="control-label col-sm-1">Disponibilité</label>-->
<!--            <div class="col-sm-4">-->
<!--                <select class="form-control" id="disponibilite" name="disponibilite">-->
<!--                    <option>disponible</option>-->
<!--                    <option>indisponible</option>-->
<!--                    <option>a_confirmer</option>-->
<!--                    <option>non_renseigne</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <div id="diffusion">
        <table class="table">
            <?php
            foreach($this->diffusion as $D){
                     DiffHelper::diff($D);
            }
            ?>

        </table>
    </div>
    <div id="lst_news">
        <table class="table">
            <?php
            foreach($this->news as $N){
                DiffHelper::news($N);
            }
            ?>

        </table>
    </div>
</div>
<!--<pre>--><?php //print_r($this->diffusion);?><!--</pre>-->
</body>
</html>
<script>



        document.getElementById('ordre').onchange = function(){
        var value = this[this.selectedIndex].value;
        document.getElementById('select-ordre').action += '&ordre='+value;
//        alert(document.getElementById('select-ordre').action)
        document.getElementById('select-ordre').submit();
    };

//    $(document).ready(function() {
//        $('#ordre').val("<?php //echo $ordre_value?>//");
//    };
</script>