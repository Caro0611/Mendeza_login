<?php
require_once('phpscripts/config.php');
$ip = $_SERVER['REMOTE_ADDR'];
//echo $ip;
if (isset($_POST['submit'])) {
    //echo "Works";
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if ($username !== "" && $password !== "") {
        $result = logIn($username, $password, $ip);
        $message = $result;
    } else {
        $message = "Please fill out the required fields.";
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main.css">
    <title>Welcome to your admin panel login</title>
</head>
<body>
<?php if ($message !== 'locked') {
    echo $message;
    ?>
    <div id="loginCont">
        <h1 class="title">Admin Login</h1>
        <section id="formSect">
            <form action="admin_login.php" method="post">
                <label class="hidden">Username:</label>
                <input type="text" name="username" placeholder="username" value="">
                <br>
                <label class="hidden">Password</label>
                <input type="password" name="password" placeholder="password" value="">
                <br><br>
                <input type="submit" name="submit" value="Sign In">
            </form>
        </section>
    </div>
<?php } else { ?>
    <div id="loginCont">
        <h1 class="title">Admin Login</h1>
        <section id="formSect">
            Your account has been locked! Please contact admin
        </section>
    </div>
<?php } ?>
</body>
</html>
