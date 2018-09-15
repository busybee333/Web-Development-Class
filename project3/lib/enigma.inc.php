<?php

require __DIR__ . "/../vendor/autoload.php";

// Start the PHP session system
session_start();

define("ENIGMA_SESSION", 'enigma3');

// If there is an Enigma session, use that. Otherwise, create one
if(!isset($_SESSION[ENIGMA_SESSION])) {
	$_SESSION[ENIGMA_SESSION] = new Enigma\System();
}

$system = $_SESSION[ENIGMA_SESSION];