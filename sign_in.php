<?php
//sign_in.php
session_start();
require_once 'dbconnect.php';
require_once 'view_shc.php';


	$error_message = $_REQUEST['error_message'];
	
	//If the user is logged in, the user_id in the session will be set
	if(!isset($_SESSION['user_id'])){
		//see if a login form was submitted with a username for login
		if(isset($_POST['username'])){
			//try and log the user in
			$username = mysql_real_escape_string(trim($_REQUEST['username']));
			$password = mysql_real_escape_string(trim($_REQUEST['password']));
			
			//look up the user
			$query = sprintf("SELECT user_id, username FROM users " .
                 " WHERE username = '%s' AND password = '%s';",
            		$username, crypt($password, $username));

			$results = mysql_query($query);

			if (mysql_num_rows($results) == 1) {
  				$result = mysql_fetch_array($results);
  				$user_id = $result['user_id'];
  				/*no longer have to set cookies when using sessions
  				setcookie('user_id', $user_id);
  				setcookie('username', $result['username']);
  				*/
  				$_SESSION['user_id'] = $user_id;
  				$_SESSION['username'] = $username;
  				header("Location: ../home.php");
  				exit();
			} else {
 			//if user not found, issue an error
 			$error_message = "Your username/password combination was invalid.";
			}
		}	
		//Still in the "not signed in" part of the if
		//start the page, and we know there's no success or error message
		// since they're just logging in
page_start_buried("Log In", NULL, NULL, $error_message);
?>
		<div class="bs-example">
			<h1>Log in</h1>
			<form class="form-horizontal" id="signin_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="form-group">
					<label for="username" class="control-label col-xs-2">User Name</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="username" id="username" placeholder="User Name">
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="control-label col-xs-2">Password</label>
					<div class="col-xs-10">
						<input type="password" class="form-control" name="password" id="password" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-10">
						<button type="submit" class="btn btn-primary" name="submit">Log In</button>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>

<?php
}else{
	// now handle the case where they're logged in
	//redirect to another page, most likely home.html
	header("Location: ../home.php");
	exit();
}
?>
