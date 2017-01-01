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
$uq = mysql_query("SELECT `username`, `password` FROM `users` WHERE `username` = '$username'", $c);
if (mysql_num_rows($uq) == 0)
{
    die(
            "<h3>breakthenet Error</h3>
	Invalid username!<br />
	<a href='login.php'>&gt; Back</a>");
}
else
{
    $mem = mysql_fetch_assoc($uq);
    $login_failed = !($mem['password'] === md5($password));
    if ($login_failed)
    {
        die(
                "<h3>breakthenet Error</h3>
		Invalid password!<br />
		<a href='login.php'>&gt; Back</a>");
    }
    session_regenerate_id();
    $_SESSION['loggedin'] = 1;
    $_SESSION['username'] = $mem['username'];
    header("Location: /index.php");
    exit;
}
