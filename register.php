<?php
require('/var/www/hackny/db.php');
$email = $_POST['username'];
$pass = $_POST['password'];
$num = $_POST['phone'];

mysql_query("INSERT INTO users VALUES (NULL,'$email', '$pass', '$num', '1')");
echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=login.php\">";

?>