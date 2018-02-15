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
  <div id="container">
    <h1 class="title">LOGIN</h1>
    <h2 id=textEnter>Please enter your Admin username and password to continue</h2>
    <section id="formSect">
      <form action="admin_login.php" method="post">
       <label class="hidden">Username:</label>
       <input type="text" name="username" placeholder="username" value="">
       <br>
       <label class="hidden">Password</label>
       <input type="password" name="password" placeholder="password" value="">
       <br><br>
       <input type="submit" name="submit" value="Sign In" class="button">
      </form>
    </section>
  </div>
<?php } else { ?>
    <div id="container">
        <h1 class="title">LOGIN</h1>
        <section id="formSect">
            Your account is blocked!
        </section>
    </div>
<?php } ?>
</body>
</html>
