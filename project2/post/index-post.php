<?php
//phpinfo();
require_once "../lib/enigma.inc.php";
$controller = new \Enigma\IndexController($system, $site, $_POST, $_SESSION);
//echo $controller->showRedirect();
header("location: " . $controller->getRedirect());
