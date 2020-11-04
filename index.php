<?php

session_start();

define('URL', str_replace('index.php', '', (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']));
define ('SITE_ROOT', realpath(dirname(__FILE__)));
define('SESSION_NAME', 'SessionId');

require_once('views/View.php');
require_once('controllers/Router.php');

$router = new Router();
$router->routeRequest();
