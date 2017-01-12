<?php
defined('Poisson') or die('Acces interdit');

?>
<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <?php echo '[%TITLE%]';?>
    <?php echo '[%STYLESHEETS%]'?>
</head>
<body>
<h1>Template Simple</h1>
<p><?php echo __FILE__; ?></p>
<!-- Afffichage de la vue -->
<?php $this->insertView(); ?>
</body>
</html>
