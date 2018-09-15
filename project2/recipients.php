<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/18/2018
 * Time: 4:58 PM
 */
require_once "lib/enigma.inc.php";
$view = new Enigma\RecipientsView($system, $site, $_GET);
if($view->getRedirect() !== null) {
    header("location: " . $view->getRedirect());
    exit;
}
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
