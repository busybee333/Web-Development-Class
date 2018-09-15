<?php
require_once "../lib/enigma.inc.php";
$controller = new \Enigma\IndexController($system, $_POST);
//echo $controller->showRedirect();
header("location: " . $controller->getRedirect());