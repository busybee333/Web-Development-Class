<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/17/2018
 * Time: 10:02 PM
 */
require_once "lib/enigma.inc.php";
$view = new Enigma\NewUserPendingView($system);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>The Endless Enigma</title>
    <?php echo $view->head(); ?>
</head>

<body>
<?php
echo $view->present();
?>
</body>
</html>
