<?php
require 'format.inc.php';
require 'wumpus.inc.php';

$room = 1; // The room we are in.
$birds = 7;  // Room with the birds
$pits = array(3, 10, 13);    // Rooms with a bottomless pit
$wumpus = 16;
$cave = cave_array(); // Get the cave
if(isset($_GET['r']) && isset($cave[$_GET['r']]) ) {
    // We have been passed a room number
    $room = $_GET['r'];
}
if(isset($_GET['a']) && isset($cave[$_GET['a']]) ) {
    // We have been passed a room number
    if($_GET['a'] == $wumpus) {
        header("Location: win.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="game.css" type="text/css" rel="stylesheet" />
        <title>Stalking the Wumpus</title>
    </head>
    <body>
    <?php echo present_header("Stalking the Wumpus"); ?>
    <div class="content">
        <figure>
            <img src="cave.jpg" width="600" height="325" alt="Cave"/>
        </figure>
        <div class="nospace">
        <?php
        echo '<p>' . date("g:ia l, F j, Y") . '</p>';
        if($room == $birds) {
            $room = 10;
        }
        if(in_array($room, $pits)){
            header("Location: lose.php");
            exit;
        }
        if($room == $wumpus){
            header("Location: lose.php");
            exit;
        }
        ?>
        </div>
        <p>You are in room <?php echo $room; ?></p>

        <div class="nospace">
            <?php
            //birds message
            if($cave[$room][0] == $birds or $cave[$room][1] == $birds or $cave[$room][2] == $birds) {
                echo '<p>You hear birds!</p>';
            }
            else {
                echo '<p>&nbsp;</p>';
            }
            //draft message
            if(in_array($cave[$room][0], $pits)) {
                echo '<p>You feel a draft!</p>';
            }
            elseif(in_array($cave[$room][1], $pits)) {
                echo '<p>You feel a draft!</p>';
            }
            elseif(in_array($cave[$room][2], $pits)) {
                echo '<p>You feel a draft!</p>';
            }
            else {
                echo '<p>&nbsp;</p>';
            }
            //wumpus message - wumpus in 16
            $smell = false;
            for($i = 0; $i < 3; $i++) {
                $temp = $cave[$room][$i];
                if($temp == $wumpus){
                    $smell = true;
                }
                for ($j = 0; $j < 3; $j++) {
                    $temp2 = $cave[$temp][$j];
                    if($temp2 == $wumpus){
                        $smell = true;
                    }
                }
            }
            if($smell == true) {
                echo '<p>You smell a wumpus!</p>';
            }
            ?>
        </div>

        <div class="rooms">
            <div class="room">
                <a href=""><img src="cave2.jpg" alt="cave2" title="cave2" width="180" height="135" /></a>
                <p><a href="game.php?r=<?php echo $cave[$room][0]; ?>"><?php echo $cave[$room][0]; ?></a></p>
                <p><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][0]; ?>">Shoot Arrow</a></p>
            </div><div class="room">
                <a href=""><img src="cave2.jpg" alt="cave2" title="cave2" width="180" height="135" /></a>
                <p><a href="game.php?r=<?php echo $cave[$room][1]; ?>"><?php echo $cave[$room][1]; ?></a></p>
                <p><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][1]; ?>">Shoot Arrow</a></p>
            </div><div class="room">
                <a href=""><img src="cave2.jpg" alt="cave2" title="cave2" width="180" height="135" /></a>
                <p><a href="game.php?r=<?php echo $cave[$room][2]; ?>"><?php echo $cave[$room][2]; ?></a></p>
                <p><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][2]; ?>">Shoot Arrow</a></p>
            </div>
        </div>
        <p id ="addpad"> You have 3 arrows remaining.</p>
    </div>
    </body>
</html>