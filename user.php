<?php

require_once 'util/dbconnect.php';
require_once 'util/SHC_config.php';
require_once 'util/view_shc.php';

$error_message = $_REQUEST['error_message'];



page_start("Admin", NULL, NULL, $error_message);
?>
	<div class="bs-example">
			<h1>Create New User</h1>
			<form class="form-horizontal" id="user_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
					<label for="email" class="control-label col-xs-2">Email</label>
					<div class="col-xs-10">
						<input type="email" class="form-control" name="email" id="email" placeholder="Email">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-xs-2">Group</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="group" id="group" placeholder="Group Name">
					</div>
				</div>
				<div class="form-group">
					<label for="name_first" class="control-label col-xs-2">First Name</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="name_first" id="name_first" placeholder="First Name">
					</div>
				</div>
				<div class="form-group">
					<label for="name_last" class="control-label col-xs-2">Last Name</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="name_last" id="name_last" placeholder="Last Name">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-10">
						<button type="submit" class="btn btn-primary" name="submit">Submit</button>
						<!--<button type="button" id="enviar" class="btn btn-default">-->
					</div>
				</div>
			</form>
		</div>
	</body>
</html>

<?php

$username = trim($_REQUEST['username']);
$password = trim($_REQUEST['password']);
$email = trim($_REQUEST['email']);
$group = trim($_REQUEST['group']);
$name_first = trim($_REQUEST['name_first']);
$name_last = trim($_REQUEST['name_last']);

if ($group == "admin"){
	$groupID = 1;
}else{
	$groupID = 2;
}
try{
$insert = sprintf("INSERT INTO users " .
					"(username, password, email, name_first, name_last)" . 
					"VALUES ('%s', '%s', '%s', '%s', '%s');" ,
					mysql_real_escape_string($username),
					mysql_real_escape_string(crypt($password, $username)),
					mysql_real_escape_string($email),
					mysql_real_escape_string($name_first),
					mysql_real_escape_string($name_last));

mysql_query($insert);
					
$ug = sprintf("INSERT INTO user_groups (user_id, group_id)" . 
					"VALUES(LAST_INSERT_ID(), %d);" ,
					mysql_real_escape_string($groupID));
mysql_query($ug);
}
catch(exception $ex){
	handle_error($ex->getMessage(), mysql_error());
}
?>
