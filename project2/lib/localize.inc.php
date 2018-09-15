<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/18/2018
 * Time: 5:42 PM
 */
return function(Enigma\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');

    $site->setEmail('yunromi@cse.msu.edu');
    $site->setRoot('/~yunromi/project2');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=yunromi',
        'yunromi',       // Database user
        'poopoo123',     // Database password
        'p2_');            // Table prefix
};