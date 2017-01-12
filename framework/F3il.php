<?php
namespace F3il;
session_start();
define('F3IL', '');
if (!defined('APPLICATION_PATH')) {
    throw new Error('erreu APPLICATION_PATH dans f3il');
}
if (!defined('APPLICATION_NAMESPACE')) {
    throw new Error('erreu APPLICATION_NAMESPACE dans f3il');
}
//require_once '/framework/page.php';
//require_once '/framework/application.php';
//require_once '/framework/configuration.php';
//require_once '/framework/error.php';
require_once '/framework/autoloader.php';
\F3il\AutoLoader::getInstance(APPLICATION_PATH,APPLICATION_NAMESPACE);