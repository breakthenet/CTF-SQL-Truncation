<?php

session_start();
if ($_POST['username'] == "" || $_POST['password'] == "")
{
    die(
            "<h3>breakthenet Error</h3>
You did not fill in the login form!<br />
<a href=login.php>&gt; Back</a>");
}
include "mysql.php";
$username =
        (array_key_exists('username', $_POST) && is_string($_POST['username']))
                ? $_POST['username'] : '';
$password =
        (array_key_exists('password', $_POST) && is_string($_POST['password']))
                ? $_POST['password'] : '';
if (empty($username) || empty($password))
{
    die(
            "<h3>breakthenet Error</h3>
	You did not fill in the login form!<br />
	<a href='login.php'>&gt; Back</a>");
}

$username = mysql_real_escape_string($username);
$password = md5($password);
$uq = mysql_query("SELECT `username`, `password` FROM `users` WHERE `username` = '$username' AND `password` = '$password'", $c);
if (mysql_num_rows($uq) == 0)
{
    die(
            "<h3>breakthenet Error</h3>
	Invalid username or password!<br />
	<a href='login.php'>&gt; Back</a>");
}
else
{
    $mem = mysql_fetch_assoc($uq);
    session_regenerate_id();
    $_SESSION['loggedin'] = 1;
    $_SESSION['username'] = $mem['username'];
    header("Location: /index.php");
    exit;
}
