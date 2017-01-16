<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 14/01/2017
 * Time: 03:10
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');

abstract class DiffHelper
{
    public static function news(array $news)
    {
        ?>
        <tr>
            <td>
                <div  style="height: 158px; ">
                    <div style="background-image: url(<?php echo $news['chemin'] ?>);background-size: cover;height: 108px;width: 192px;float: left;"></div>
                    <div style="float:right;height: 108px; width: 35%;overflow: hidden;margin: 0 auto;">
                        <p>Par:<?php echo strtoupper($news['nom']) ?></p>
                        <p>Le:<?php echo $news['dateheurecreation'] ?></p>
                    </div>
                    <div style="clear:both; height: 50px; width: 100%;">
                        <div style="width: 80%;float: left;">
                            <h2 <?php echo DiffHelper::etat($news['id']); ?>>
                                <?php echo $news['titre'] ?>
                            </h2>
                        </div>
                            <button name="id" value="<?php echo $news['id'];?>" class='btn btn-group-sm' style="float: right;margin-top: 15px;" form="ajouter-diff">Ajouter</button>
                    </div>
                </div>
            </td>
        </tr>
        <form id="ajouter-diff" method="POST" action="?controller=diffusion&action=ajouter">
        <?php

    }

    public static function etat($id)
    {
        $mode= new DiffusionModel();
        if($mode->newsetat($id)){
            return 'style="color : red;"';
        }

    }

    public static function diff(array $diffusion)
    {
        ?>
        <tr>
            <td><?php echo $diffusion['ordre']?></td>
            <td>
            <div style="height: 158px; ">
                <div style="background: url(<?php echo $diffusion['chemin']?>);background-size: cover;height: 108px;width: 192px;float: left;"></div>
                <div style="float:left;height: 108px; width: 50%;overflow: hidden;margin: 0 auto;">
                    <p>Par:<?php echo $diffusion['nom']?></p>
                    <p>Le:<?php echo $diffusion['dateheurecreation']?></p>
                </div>
                <div style="clear:both; height: 50px; width: 100%;">
                    <div style="width: 80%;float: left;"><h2><?php echo $diffusion['titre'] ?></h2></div>
                <!--                                <div style="width: 20%;height:100%;float: left">-->
                <!--                                    -->
                <!--                                </div>-->
                </div>
            </div>
        </td>
                <td><?php echo $diffusion['tempsdiffusion']?>s</td>
                <!-- onclick : fait apparaître une fenêtre pour changer durée de diffusion-->
                <td>
                    <a href="?controller=diffusion&action=modifiertemps&ordre=<?php echo $diffusion['ordre']?>&temps=<?php echo $diffusion['tempsdiffusion']?>"><span ><i class="fa fa-clock-o" aria-hidden="true"></i></span></a>
                </td>
                <td>
                    <a href="?controller=diffusion&action=supprimer&ordre=<?php echo $diffusion['ordre']?>"><span><i class="fa fa-ban" aria-hidden="true"></i></span></a>
                </td>
            </tr>
<!--            <input type="hidden" name="id" value="--><?php //echo $diffusion['id'];?><!--" form="delete-diff">-->
<!--        <form id="delete-diff" method="POST" action="?controller=diffusion&action=supprimer">-->
        <?php
    }

}