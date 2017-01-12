<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 05/01/2017
 * Time: 13:28
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');
\F3il\Messages::setMessageRenderer('\Poisson\MessagesHelper::messagesRenderer');

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>PROJECT POISSON</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div>
    <div class="titre">
        <h1><span>3</span>I NEWS</h1>
    </div>
    <div class="container">

        <?php $this->formulaire->render(); ?>
        [%MESSAGES%]
    </div>
</div>

</body>
</html>

