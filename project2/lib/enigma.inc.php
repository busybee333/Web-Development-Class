<?php

require __DIR__ . "/../vendor/autoload.php";

$site = new Enigma\Site();
$localize = require 'localize.inc.php';
if(is_callable($localize)) {
    $localize($site);
}

// Start the PHP session system
session_start();

define("ENIGMA_SESSION", 'system');


if(!isset($_SESSION[ENIGMA_SESSION]))  {
    $_SESSION[ENIGMA_SESSION] = new Enigma\System();
}

$system = $_SESSION[ENIGMA_SESSION];

$user = null;
if(isset($_SESSION[Enigma\User::SESSION_NAME])) {
    $user = $_SESSION[Enigma\User::SESSION_NAME];
}