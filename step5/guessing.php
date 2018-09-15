<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 5/31/2018
 * Time: 9:57 PM
 */
require __DIR__ . '/lib/guessing.inc.php';

$view = new Guessing\GuessingView($guessing);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="guessing.css" type="text/css" rel="stylesheet" />
        <title>Guessing Game</title>
    </head>
    <body>
        <form method="post" action="guessing-post.php">
            <fieldset>
                <?php echo $view->present(); ?>
            </fieldset>
        </form>
    </body>
</html>