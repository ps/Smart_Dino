<?php

//Destroys any prior session and begins a new session
session_start();
unset($_SESSION['validUser']);
session_destroy();
session_start();


require('/var/www/hackny/db.php');	//database connection
require('/var/www/hackny/user_auth_fns.php');	//User Authentication Functions

?>




<?php
//Check to see if username and password fields are completed.
if (isset($_POST['username']) && isset($_POST['password']))
{
	$userName = strtolower($_POST['username']);
	//$password = sha1($_POST['password']);
	$password = strtolower($_POST['password']);

	//Check for valid login and assign username to the session.
	if (login($userName, $password))
	{
		$_SESSION['validUser'] = $userName;
	}
}


//If login is valid, forward to administrative page.
if (isset($_SESSION['validUser']))
{
		echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=back.php\">";
		exit();
}
//If login is invalid, display login prompt.
else
{
	?>
<!doctype html>
<html>
  
  <head>
    <title>Smart Dino Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <link rel="stylesheet" href="https://app.divshot.com/css/bootstrap.css">
    <link rel="stylesheet" href="https://app.divshot.com/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="https://djyhxgczejc94.cloudfront.net/builds/80037b02082b29f5f9cea127cab2a4ba4365ec67.css">
    <script src="https://app.divshot.com/js/jquery.min.js"></script>
    <script src="https://app.divshot.com/js/bootstrap.min.js"></script>
  </head>
  
  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#">Smart Dino</a>
          <div class="navbar-content">
            <ul class="nav ">
              <li>
                <a href="index.html">Home</a> 
              </li>
              <li class="active">
                <a href="login.php">Login</a> 
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="hero-unit hidden-phone">
        <h2>Smart Dino Login</h2>
        <p>Login to view your preset configurations.</p>
       <!-- <div class="controls pull-right">
          <h4>Register</h4>
          <label class="control-label">Email</label>
          <input class="input-medium" type="text" name="username">
          <label class="control-label">Password</label>
          <input class="input-medium" type="password" name="password">
          <label class="control-label">Phone Number</label>
          <input class="input-medium" type="text" name="phone">
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Sign Up</button>
            <input class="btn" value="Reset" type="reset"> 
          </div>
        </div>
      </form> -->
	<?php
	

	if (isset($_POST['username']) && isset($_POST['password']))
	{
			echo "<div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>This combination of email and password does not exist!</div>";
	}
	
        ?>
        <label class="pull-right">Another image by Embedly!</label>
        <form id="username" class="form-vertical" action="login.php" method="post">
        <label>Email:</label>
        <input class="input-medium" type="text" name="username">
        <img class="pull-right" src="https://i.embed.ly/1/display/resize?key=ba62f1940127443f96851d668e8779a3&amp;url=http://www.iphoneforums.net/wallpapers/data/500/brick_phone.JPG&amp;height=300">
        <label>Password</label>
        <input class="input-medium" type="password" name="password">
        <p>
          <button type="submit" class="btn btn-primary">Login</button></form>
        </p>

      </div>
      <div class="row main-features"></div>
    </div>
  </body>

</html>
       <!-- <form id="username" class="form-vertical" action="login.php" method="post">
         <h4>Login</h4>
        <label class="control-label">Email</label>
        <input class="input-medium" type="text" name="username">
        <label class="control-label">Password</label>
        <input class="input-medium" type="password" name="password">
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
      </div>
    </div>
  </body>

</html>-->
        <?php
   
}
?>	
