<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 05/01/2017
 * Time: 14:47
 */
namespace Poisson;
use F3il\AuthenticationInterface;

defined('Poisson') or die('Acces interdit');
$authentication=\F3il\Authentication::getInstance();
$user=$authentication->getLoggedUser();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="vendors/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!--    <link href="library/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
    <!--    <link href="css/application.css" type="text/css" rel="stylesheet">-->
    <!--    <link href="css/bootstrap-datepicker.min.css" type="text/css" rel="stylesheet">-->
    <!--    <script src="js/ckeditor/ckeditor.js"></script>-->
    <!--    <script src="library/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>-->
    <!--    <script src="library/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>-->
    <!--    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <!--    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
    <!--    <script>-->
    <!--        $(function () {-->
    <!--            $("#date").datepicker({dateFormat: 'yy-mm-dd'});-->
    <!--        });-->
    <!--    </script>-->
    <!--    <script>-->
    <!--        $(function () {-->
    <!--            $("#dialog").dialog({-->
    <!--                buttons: {"Ok": function () {-->
    <!--                    $(this).dialog("close");-->
    <!--                }}-->
    <!--            });-->
    <!--        });-->
    <!--    </script>-->
</head>
<body>

<main>

    <nav class="navbar navbar-inverse navbar-fixed-top ">
        <div class="container">
            <div class="navbar-header">
                <h1 id="brand" class="brand">ASSOCIATION 3IL</h1>
            </div>
            <div>
                <ul class=" nav navbar-nav  ">
                    <li><a><?php echo $user['nom'].".".$user['prenom'] ;?></a></li>
                </ul>
            </div>
            <div class="nav navbar-nav navbar-right ">
                <button type="submit" class="btn btn-link"><a href="?controller=utilisateur&action=deconnecter"> Se Déconnecter</a></button>
            </div>

        </div>
    </nav>
    <section style="margin-top: 80px;">
        <div class="container">
            <div class="col-md-3">
                <div>
                    <!--                <ul class="list-group">-->
                    <!--                    <li class="list-group-item">-->
                    <!--                        <a href="#" class="list-group-item">Liste De Evenement<span class="badge">0</span></a>-->
                    <!--                        <a href="#" class="list-group-item">Liste De Utilisateur<span class="badge">0</span></a>-->
                    <!--                        <a href="#" class="list-group-item">Disponibilité</a>-->
                    <!--                </ul>-->
                    <?php NavigationHelper::render(); ?>
                </div>
            </div>
            <div class="col-md-9">
                [%VIEW%]
            </div>
        </div>
    </section>

</main>
<!--<script src="library/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>-->
<!--<script src="library/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>-->
</body>
</html>

