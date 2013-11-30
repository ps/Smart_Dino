<?php
/*
This page is the main back end of the system.
 */

session_start();
require('include/db.php');

/*Check if user logged it*/
if (!isset($_SESSION['validUser']))
{
    echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=login.php\">";
    exit();
}

$user = $_SESSION['validUser'];
$data = mysqli_query($con, "SELECT * FROM users WHERE email='$user'") or die("Query failed: ".mysqli_error($con));

$row = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
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
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <link rel="stylesheet" href="https://app.divshot.com/css/bootstrap.css">
    <link rel="stylesheet" href="https://app.divshot.com/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="https://djyhxgczejc94.cloudfront.net/builds/80037b02082b29f5f9cea127cab2a4ba4365ec67.css">
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="index.html">Smart Dino</a>
          <div class="navbar-content">
            <ul class="nav ">
              <li class="active">
                <a href="index.html">Home</a> 
              </li>
              <li>
                <a href="login.php">Logout</a> 
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
        
		<?php 

    /* fetch all of the filters for this user*/
		$userid = $row['id'];
		$data2 = mysqli_query($con, "SELECT * FROM filters WHERE user_id='$userid'") or die("Query failed: ".mysqli_error($con));

    if(mysqli_num_rows($data2)>0)
    {
      echo "<table border=\"1\" cellpadding=\"5px\"><tr><td ><b>Filter</b></td><td><b>Keyword</b></td></tr>";
  		while($row2 = mysqli_fetch_array($data2))
  		{
  			echo "<tr>";
  			echo "<td>".$row2['filter_type']."</td>";
  			echo "<td>".$row2['filter_text']."</td>";
  			echo "</tr>";
  		}
      echo "</table>";
    }
    else
    {
      echo "No filters found. Please fill out data and click 'Add' to add a new filter.";
    }
		?>

        <p></p>
      </div>
      <a class="btn btn-large btn-primary btn-block visible-phone" href="#"><span class="btn-label">Sign Up Today!</span></a>
      <div class="row main-features"></div>
    </div>

  </body>

</html>