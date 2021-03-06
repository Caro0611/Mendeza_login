<?php
function logIn($username, $password, $ip)
{
    require_once('connect.php');
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $userQuery = "SELECT * FROM tbl_user WHERE user_name='{$username}'";
    $user = mysqli_query($link, $userQuery);
    if (mysqli_num_rows($user)) {
        $founduser = mysqli_fetch_array($user, MYSQLI_ASSOC);
        $id = $founduser['user_id'];
        $user_attempt = $founduser['user_attempt'];
        if ($user_attempt >= 3) {
            return 'locked';
        }
        if ($founduser['user_pass'] === $password) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $founduser['user_fname'];
            $_SESSION['user_date'] = $founduser['user_date'];

            $update = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
            $updatequery = mysqli_query($link, $update);

            //date and time of LAST login
            $lastLog = "UPDATE tbl_user SET user_date = NOW()  WHERE user_id = {$id}";
            $showTime = mysqli_query($link, $lastLog);

            $clearAttemptQuery = "UPDATE tbl_user SET user_attempt = 0 WHERE user_id = {$id}";
            $clearAttempt = mysqli_query($link, $clearAttemptQuery);
            redirect_to("admin_index.php");
        } else {
            $user_attempt = 3 - $user_attempt - 1; //
            $increse = "UPDATE tbl_user SET user_attempt = user_attempt + 1 WHERE user_id={$id}";
            $clearAttempt = mysqli_query($link, $increse);

            $message = "Login Attempt failed <br> Verify your user id and password and try again."; //message to display if login fails
            if ($user_attempt < 3) { //if user_attempt <3 times display $message and number of attempt
                $message .= "You have {$user_attempt} more attempts."; //displays numbers of attempts left
            } else {
                $message = 'locked';
            }
        }
    }
    return $message;
    mysqli_close($link);
}

?>
