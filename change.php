<?php
session_start();
require('/var/www/hackny/db.php');

$user = $_SESSION['validUser'];

$data = mysql_query("SELECT * FROM users WHERE email='$user'");
$row = mysql_fetch_array($data);
if($row['check_mail']==1)
{
	mysql_query("UPDATE users SET check_mail='0' WHERE email='$user'");
}
else if($row['check_mail']==0)
{
	mysql_query("UPDATE users SET check_mail='1' WHERE email='$user'");

}
echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=back.php\">";
?>