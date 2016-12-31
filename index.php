<?php

session_start();
require "global_func.php";
if ($_SESSION['loggedin'] == 0)
{
    header("Location: login.php");
    exit;
}
$username = $_SESSION['username'];
require "header.php";
$h = new headers;
$h->startheaders();
include "mysql.php";
global $c;
$is = mysql_query("SELECT * FROM users WHERE username='{$username}'") or die(mysql_error());
$ir = mysql_fetch_array($is);
print
        "<h1>You have logged on, {$ir['username']}!</h1>
<h2>Welcome back!</h2>";
print "<br><br>Your userid is {$ir['id']}:<br><br><br>";

if($ir['id'] == 1) {
    print "<font color='green'>Admin panel ENABLED. Congrats, you beat the test and are logged in as user admin with ID=1.</font>";
}
else {
    print "<font color='red'>Admin panel disabled. Must be logged in as admin (id=1) to access.</font>";
}

print "<br><br><br>
&gt; <a href='logout.php'>LOGOUT</a>
LOGOUT BUTTON
IF admin user, display success code here
";
$h->endpage();
