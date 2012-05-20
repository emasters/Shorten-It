<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once 'classes/Auth.class.php';

session_start();

$auth = new Auth();

if (isset($_POST['email']) && isset($_POST['password'])) {
	$status = $auth->login($_POST['email'], $_POST['password']);
	//echo $status;
	if ($status == 0) {
		header('Location: index.php');
	}
	else {
		switch ($status) {
			case 1:
				$error = 'User not verified, please check your email for verification';
				//break;
			case 2:
				$error = 'User is not active, please check your email for activation information';
				//break;
			case 3:
				$error = 'Username and password correct, but issue logging in, try again.';
				//break;
			case 4:
				$error = 'Error logging in, please check username and/or password and try again';
				//break;
		}?>
		    <div class="alert alert-error">
			    <a class="close" data-dismiss="alert" href="#">×</a>
			    <h4 class="alert-heading">Login Error!</h4>
			    <?php echo $error; ?>
		    </div>
	<?php
	}
}
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
 	<script type="text/javascript" src="./js/jquery-1.7.2.min.js"></script>
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
          <a class="brand" href="index.php">Shorten It</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="index.php#about">About</a></li>
              <li><a href="index.php#contact">Contact</a></li>
              <li class="active"><a href="#login">Login</a></li>
              <li><a href="register.php">Register</a></li>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<div class="container">
        <div class="content">
	      <?php  if (isset($_GET['verified'])) {
				echo 'Your account is verified, please login below <br />';
			}
			?>  
			<div class="row">
                <div class="login-form">
                    <h2>Login</h2>
                    <form method="post" action="login.php" name="loginForm">
						
                        <fieldset>
                            <div class="clearfix">
                                <input type="text" placeholder="Email" name="email">
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
    <script type="text/javascript">
    	$(".alert").alert('close')
    </script>
    <script src="./js/bootstrap/bootstrap-transition.js"></script>
    <script src="./js/bootstrap/bootstrap-alert.js"></script>
    <script src="./js/bootstrap/bootstrap-modal.js"></script>
    <script src="./js/bootstrap/bootstrap-dropdown.js"></script>
    <script src="./js/bootstrap/bootstrap-scrollspy.js"></script>
    <script src="./js/bootstrap/bootstrap-tab.js"></script>
    <script src="./js/bootstrap/bootstrap-tooltip.js"></script>
    <script src="./js/bootstrap/bootstrap-popover.js"></script>
    <script src="./js/bootstrap/bootstrap-button.js"></script>
    <script src="./js/bootstrap/bootstrap-collapse.js"></script>
    <script src="./js/bootstrap/bootstrap-carousel.js"></script>
    <script src="./js/bootstrap/bootstrap-typeahead.js"></script>
</body>
</html>	