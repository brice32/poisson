<?php
$data = parse_ini_file('1configuration.ini');

if (!$data) {
    die('Fichier non lisible');
}
?>
<pre><?php print_r($data); ?></pre>    