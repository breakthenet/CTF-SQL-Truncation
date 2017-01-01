<?php
session_start();
$username = $_SESSION['username'];
if (!$username) {
    header("Location: login.php");
    exit;
}

include "mysql.php";
$is = mysql_query("SELECT * FROM users WHERE username='{$username}'") or die(mysql_error());
$ir = mysql_fetch_array($is);
print "<h1>You have logged on, {$ir['username']}!</h1>
<h2>Welcome back!</h2>";
print "<br><br>Your userid is {$ir['id']}<br><br><br>";

if($ir['id'] == 1) {
    $ctf_flag = getenv('CTF_FLAG');
    print "<font color='green'>Admin panel ENABLED. Congrats, you beat the test and are logged in as user admin with ID=1.<br><br>CTF Flag: ".$ctf_flag."</font>";
}
else {
    print "<font color='red'>Admin panel disabled. Must be logged in as admin (id=1) to access.</font>";
}

print "<br><br><br>
&gt; <a href='logout.php'>LOGOUT</a>
";
