<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 05/01/2017
 * Time: 14:47
 */
namespace Poisson;

defined('Poisson') or die('Acces interdit');
$authentication = \F3il\Authentication::getInstance();
$user = $authentication->getLoggedUser();

?>
<!DOCTYPE html>
<html>
<head>
<!--    <title>PROJET POISSON</title>-->
    <?php echo $this->insertPageTitle(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<header>

    <h2><span>3</span>I NEWS</h2>
    <div class="nomPage"><?php echo $this->getPageTitle();?></div>
    <div class="utilisateur">
        <?php echo strtoupper($user['nom']) . " " . ucfirst($user['prenom']); ?>
        <a href="?controller=utilisateur&action=deconnecter">
            <span id="logout">
                <i class="fa fa-power-off" aria-hidden="true"></i>
            </span>
        </a>
    </div>
</header>
<nav>
    <?php NavigationHelper::render(); ?>
</nav>
<div class="container">
    [%VIEW%]
</div>
