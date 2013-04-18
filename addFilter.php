<?php
require('/var/www/hackny/db.php');

$filterType = $_POST['filter'];
$word = $_POST['filter_word'];
$userID = $_POST['user_id'];

mysql_query("INSERT INTO filters VALUES (NULL, '$userID', '$filterType', '$word')");
echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=back.php\">";
?>