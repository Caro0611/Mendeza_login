<?php
require_once('phpscripts/config.php');
confirm_logged_in();
?>
<!doctype html>
<html>
<head>
 <meta charset="UTF-8">
 <title>WELCOME!</title>
</head>
<body>
<?php
$time = date("H");

if ($time < "12") {
    $greeting = "Good morning Buenos dias!";
} else if ($time >= "12" && $time < "17") {
    $greeting = "Good afternoon! Buenas tardes!";
} else if ($time >= "17") {
    $greeting = "Good evening! Buenas noches!";
}
?>
<h3><?php echo $greeting . ' ' . $_SESSION['user_name']; ?></h3>
<h5><?php echo 'Last Login time ' . $_SESSION['user_date']; ?></h5>
</body>
</html>
