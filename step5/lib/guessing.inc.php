<?php
require __DIR__ . "/../vendor/autoload.php";

// Start the PHP session system
session_start();

define("GUESSING_SESSION", 'guessing');

// If there is a Guessing session, use that. Otherwise, create one
if(!isset($_SESSION[GUESSING_SESSION])) {
    $_SESSION[GUESSING_SESSION] = new Guessing\Guessing();
}

if(isset($_GET['seed'])) {
    $_SESSION[GUESSING_SESSION] = new Guessing\Guessing(strip_tags($_GET['seed']));
}

$guessing = $_SESSION[GUESSING_SESSION];


