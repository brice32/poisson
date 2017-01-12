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
        array('title' =>'Sujets','controller'=>'sujet'),
        array('title' =>'Suivis','controller'=>'suivi'),
        array('title' =>'Utilisateurs','controller'=>'utilisateur')
    );

    public static function render(){
        $app=\F3IL\Application::getInstance();
        $location=$app->getCurrentLocation();
        ?>
        <ul class="list-group">
                    <li class="list-group-item">
<!--                        <a href="#" class="list-group-item">Sujets<span class="badge">0</span></a>-->
<!--                        <a href="#" class="list-group-item">Suivis<span class="badge">0</span></a>-->
<!--                        <a href="#" class="list-group-item">Utilisateurs</a>-->
            <?php
            foreach (self::$menu as $item){
                self::itemRenderer($item,$location);
            }
            ?>
                    </li>
                </ul>

        <?php
    }

    private static function itemRenderer($item,$location){
            ?>
            <a href="<?php echo '?controller=' . $item['controller']; ?>"
               class="list-group-item <?php if($item['controller']==$location['controller']) echo 'active';?>"><?php echo $item['title']; ?><span class="badge">0</span></a>
            <?php
    }
}