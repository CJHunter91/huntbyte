<?php
require_once("includes/config.php");
//check if already logged in
if( $user->is_logged_in() ){ header('Location: index.php'); } 

   $pageArray = array(
"name"  => "HuntByte - Login",
"style" => "style/",
"images" => "images/",
"boot" => "bootstrap/css/");

include('includes/header.php');
include('includes/menu.php');?>
<script>
$( "li:contains('Login')" ).addClass("active");
</script>
       
        <div class="right">
            <h2><span>Login</span></h2>
            
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
    		<form method="post" action="login.php">
            	<form action="" method="post">
	<p><label>Username</label></br><input class="input" type="text" name="username" value=""  /></p>
	<p><label>Password</label></br><input class="input" type="password" name="password" value=""  /></p>
	<p><label></label><input id="submit" class="submit" type="submit" name="submit" value="Login"  /></p>
	</form>
            </div>
        </div>
<?php include('includes/footer.php');?>