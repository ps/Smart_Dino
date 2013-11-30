<?php
//setting up database connection

$con = mysqli_connect("localhost", "<user>","<password>") or die("Could not connect: ".mysqli_error($con));
mysqli_select_db($con, "<smart dino db>") or die("Could not select db: ".mysqli_error($con));

?>
