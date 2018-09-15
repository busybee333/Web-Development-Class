<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/18/2018
 * Time: 5:45 PM
 */
require '../lib/enigma.inc.php';

$controller = new Enigma\NewUserPendingController($system, $site, $_POST);
header("location: " . $controller->getRedirect());