<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/27/2018
 * Time: 10:12 PM
 */

require_once "../lib/enigma.inc.php";

$controller = new \Enigma\EnigmaController($system, $_POST);
//header("location: " . $controller->getRedirect());
echo $controller->getResult();
