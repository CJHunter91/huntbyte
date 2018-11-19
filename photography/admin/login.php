<?php
//include config
require_once('../includes/config.php');


//check if already logged in
if( $user->is_logged_in() ){ header('Location: index.php'); } 
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin Login</title>
  <link rel="stylesheet" href="../style/main.css">
</head>
<body>

<div id="login">
	<h2>Admin Login</h2>
	<?php

	//process login form if submitted
	if(isset($_POST['submit'])){

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		if($user->login($username,$password)){ 

			//logged in return to index page
			header('Location: index.php');
			exit;
		

		} else {
			$message = '<p class="error">Wrong username or password</p>';
		}

	}//end if submit

	if(isset($message)){ echo $message; }
	?>

	<form class=hasflex style="flex-direction:column" action="" method="post">
	<p><label>Username</label><input type="text" name="username" value="" placeholder="Username" /></p>
	<p><label>Password</label><input type="password" name="password" value=""  placeholder="Password" /></p>
	<p><label></label><input type="submit" name="submit" value="Login"  /></p>
	</form>

</div>
</body>
</html>
			