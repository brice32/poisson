<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 12/12/2016
 * Time: 04:17
 */
namespace Poisson;
defined("Poisson") or die("Acess interdit form.view");

?>
<head>
    <title>Form Test</title>
</head>
<div>
    <h2><?php echo $this->pageTitle ?></h2>
    <?php
    $this->formulaire->render();
    ?>
    <pre><?php
//        print_r($this->formData);
        print_r($this->formulaire);
        print_r($_POST);
//        print_r($this->b);
//        echo $this->b;
        ?></pre>
</div>
