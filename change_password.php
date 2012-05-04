<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once 'classes/Auth.class.php';

session_start();

$auth = new Auth();

if (!$auth->checkSession()) {
	header("Location: login.php");
}
else if (isset($_POST['curpw']) 
			&& isset($_POST['newpw1'])
			&& isset($_POST['newpw1'])) {
	if ($_POST['newpw1'] == $_POST['newpw2']) {
		if ($auth->changePassword($_SESSION['user_id'], $_SESSION['email'], $_POST['curpw'], $_POST['newpw1'])) {
			echo 'Password change successfully';
		}
		else {
			echo 'Issue changing password';
		}
	}
	else {
		$error = 'New passwords do not match';
	}
}
else ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Shorten It - Profile</title>
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
<form name="changepw" action="change_password.php" method="post">
Current Password: <input type="password" name="curpw" />
<br />New Password: <input type="password" name="newpw1" />
<br />Verify New Password: <input type="password" name="newpw2" />
<input type="submit" value="Change Password" />

</form>
</body>

</head>
</html>