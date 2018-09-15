<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/17/2018
 * Time: 11:00 PM
 */
require_once "lib/enigma.inc.php";
$view = new Enigma\PasswordValidateView($system, $site, $_GET);
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