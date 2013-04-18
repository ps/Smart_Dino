<?php
session_start();
require('/var/www/hackny/db.php');


$user = $_SESSION['validUser'];
$data = mysql_query("SELECT * FROM users WHERE email='$user'");

$row = mysql_fetch_array($data);




?>
<!doctype html>
<html>
  
  <head>
    <title>Smart Dino</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <link rel="stylesheet" href="https://app.divshot.com/css/bootstrap.css">
    <link rel="stylesheet" href="https://app.divshot.com/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="https://djyhxgczejc94.cloudfront.net/builds/80037b02082b29f5f9cea127cab2a4ba4365ec67.css">
    <script src="https://app.divshot.com/js/jquery.min.js"></script>
    <script src="https://app.divshot.com/js/bootstrap.min.js"></script>
  </head>
  
  <body>
    <title>login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <link rel="stylesheet" href="https://app.divshot.com/css/bootstrap.css">
    <link rel="stylesheet" href="https://app.divshot.com/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="https://djyhxgczejc94.cloudfront.net/builds/80037b02082b29f5f9cea127cab2a4ba4365ec67.css">
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#">Smart Dino</a>
          <div class="navbar-content">
            <ul class="nav ">
              <li class="active">
                <a href="#">Home</a> 
              </li>
              <li>
                <a href="#">About</a> 
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="hero-unit hidden-phone">
        <h2>Smart Dino Dashboard</h2>
        <p>Username: <?php echo $row['email']?></p>
        <p>Phone #: <?php echo $row['phone_num']?></p>
        <?php 
        	if($row['check_mail']==1)
			{
				echo "<p>Current Status: WAITING FOR EMAIL <a href=\"change.php\">Click to turn off.</a></p>";
			}
			else if($row['check_mail']==0)
			{
				echo "</p>Current Status: NOT CHECKING EMAIL <a href=\"change.php\">Click to turn on.</a></p>";

			}
        ?>
        <form id="username" class="form-vertical" action="addFilter.php" method="post">
          <span class="help-inline">Filter: </span>
          <select name="filter">
            <option vale="all">ALL</option>
            <option value="sender">Sender</option>
            <option value="subject">Email Subject</option>
            <option value="message">Message</option>
          </select>
          <span class="help-inline" > Keyword: </span>
          <input class="input-large" type="text" name="filter_word">
          <input type="hidden" name="user_id" value="<?php echo $row['id'];?>">
          <button type="submit" class="btn btn-primary">Add</button></form> 
        </form>
        <table border="1" cellpadding="5px">
		<tr><td ><b>Filter</b></td><td><b>Keyword</b></td></tr>
		<?php 
		$userid = $row['id'];
		$data2 = mysql_query("SELECT * FROM filters WHERE user_id='$userid'");

		while($row2 = mysql_fetch_array($data2))
		{
			echo "<tr>";
			echo "<td>".$row2['filter_type']."</td>";
			echo "<td>".$row2['filter_text']."</td>";
			echo "</tr>";
		}
		?>


		</table>
        <p></p>
      </div>
      <a class="btn btn-large btn-primary btn-block visible-phone" href="#"><span class="btn-label">Sign Up Today!</span></a>
      <div class="row main-features"></div>
    </div>

  </body>

</html>