<?php
require_once 'classes/Auth.class.php';

session_start();

$auth = new Auth();

if (isset($_POST['username']) && isset($_POST['password'])) {
	$status = $auth->login($_POST['username'], $_POST['password']);
	
	if ($status == 0) {
		header('Location: index.php');
	}
	else {
		switch ($status) {
			case 1:
				$error = 'User not verified, please check your email for verification';
				break;
			case 2:
				$error = 'User is not active, please check your email for activation information';
				break;
			case 3:
				$error = 'Username and password correct, but issue logging in, try again.';
				break;
			case 4:
				$error = 'Error logging in, please check username and/or password and try again';
				break;
		}
	}
}
else {
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Shorten It - Login</title>
    <meta name="description" content="">
    <meta name="author" content="">
 
    <!-- Le styles -->
    <link href="./css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px;
      }
      .container {
        width: 300px;
      }
 
      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px;
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }
 
      .login-form {
        margin-left: 65px;
      }
 
      legend {
        margin-right: -50px;
        font-weight: bold;
        color: #404040;
      }
 
    </style>
 
</head>
<body>
	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
        	
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Shorten It</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="active"><a href="#login">Login</a></li>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<div class="container">
        <div class="content">
            <div class="row">
                <div class="login-form">
                    <h2>Login</h2>
                    <form method="post" action="login.php" name="loginForm">
						<?php if (isset($error)) {
							echo 'There was an issue logging in. Error: ' . $error . '<br />';
						}
						else if (isset($_GET['verified'])) {
							echo 'Your account is verified, please login below <br />';
						}
						?>
                        <fieldset>
                            <div class="clearfix">
                                <input type="text" placeholder="Username" name="username">
                            </div>
                            <div class="clearfix">
                                <input type="password" placeholder="Password" name="password">
                            </div>
                            <button class="btn btn-primary" type="submit">Sign in</button>
                        </fieldset>
                        <a href="forgot_password.php">Forgot Password</a>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
</form>
</body>
</html>	
	<?php 
}
?>