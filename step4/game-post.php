<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 5/29/2018
 * Time: 7:35 PM
 */
require 'lib/game.inc.php';
$controller = new Wumpus\WumpusController($wumpus, $_GET);
if($controller->isReset()) {
    unset($_SESSION[WUMPUS_SESSION]);
}
if($controller->cheatMode()) {
    unset($_SESSION[WUMPUS_SESSION]);
    $_SESSION[WUMPUS_SESSION] = new Wumpus\Wumpus(1422668587);
}

header('Location: ' . $controller->getPage());