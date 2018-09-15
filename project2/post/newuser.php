<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/17/2018
 * Time: 10:55 PM
 */
require '../lib/enigma.inc.php';
//phpinfo();
$controller = new Enigma\NewUserController($system, $site, $_POST);
header("location: " . $controller->getRedirect());