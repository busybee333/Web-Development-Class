<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/17/2018
 * Time: 11:08 PM
 */
require '../lib/enigma.inc.php';
//phpinfo();
$controller = new Enigma\PasswordValidateController($system, $site, $_POST);
header("location: " . $controller->getRedirect());