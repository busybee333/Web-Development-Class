<?php
require_once "../lib/enigma.inc.php";
$controller = new \Enigma\BatchController($system, $site, $_POST);
//echo $controller->showRedirect();
header("location: " . $controller->getRedirect());