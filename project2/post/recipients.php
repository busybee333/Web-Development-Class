<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/19/2018
 * Time: 8:28 PM
 */
require '../lib/enigma.inc.php';
//phpinfo();
$controller = new Enigma\RecipientsController($system, $site, $_POST);
header("location: " . $controller->getRedirect());