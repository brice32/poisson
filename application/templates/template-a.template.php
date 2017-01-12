<?php
defined('Poisson') or die('Acces interdit');
defined('F3IL') or die('Acces Interdit');
//$page=\F3il\Page::getInstance();
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <style type="text/css">
        body * {
            font-family: Arial;
            margin: 0;
        }

        header {
            min-height: 200px;
            background-color: #DDDDDD;
            text-align: center;
        }

        nav {
            min-height: 40px;
            background-color: #3E3D88;
            color: white;
        }

        main > * {
            float: left;
        }

        main > section {
            width: 80%;
        }

        main > aside {
            width: 20%;
            background-color: #7A3466;
            color: white;
            min-height: 400px;
        }
    </style>
            <?php echo '[%TITLE%]';?>
            <?php //$this->insertStyleSheets();?>
            <?php echo '[%STYLESHEETS%]'?>
</head>
<body>
<header>
    <h1>Template A</h1>
    <p><?php echo __FILE__; ?></p>

</header>
<nav>
    <p>Navigation</p>
</nav>
<main>
    <section>
        <!-- Afffichage de la vue -->
        <?php echo '[%VIEW%]'; ?>
        [%STYLE%]
    </section>
    <aside>
        Aside
    </aside>
</main>
</body>
</html>
