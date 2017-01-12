<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 05/01/2017
 * Time: 20:11
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');

class NavigationHelper{

    private static $menu = array(
        array('title' =>'Diffusion','controller'=>'diffusion'),
        array('title' =>'Utilisateurs','controller'=>'utilisateur')
    );

    public static function render(){
        $app=\F3IL\Application::getInstance();
        $location=$app->getCurrentLocation();
        ?>
        <ul>

<!--                        <a href="#" class="list-group-item">Sujets<span class="badge">0</span></a>-->
<!--                        <a href="#" class="list-group-item">Suivis<span class="badge">0</span></a>-->
<!--                        <a href="#" class="list-group-item">Utilisateurs</a>-->
            <?php
            foreach (self::$menu as $item){
                self::itemRenderer($item,$location);
            }
            ?>

                </ul>

        <?php
    }

    private static function itemRenderer($item,$location){
            ?>
        <li>
            <a href="<?php echo '?controller=' . $item['controller']; ?>"><?php echo $item['title']; ?></a>
        </li>
            <?php
    }
}