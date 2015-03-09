<?php
	require_once 'util/dbconnect.php';
	require_once 'util/SHC_config.php';
	require_once 'util/view_shc.php';
	require_once 'util/authorize.php';
	
	session_start();
	
	//authorize any user, as long as they're logged in
	
authorize_user();
	
	$error_message = $_REQUEST['error_message'];
	
page_start("New Member", NULL, NULL, $error_message);
?>
		<div class="bs-example">
			<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="form-group">
					<label for="name_first" class="control-label col-xs-2">First Name</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="name_first" id="name_first" placeholder="First Name">
					</div>
				</div>
				<div class="form-group">
					<label for="name_middle" class="control-label col-xs-2">Middle Name</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="name_middle" id="name_middle" placeholder="Middle Name">
					</div>
				</div>
				<div class="form-group">
					<label for="name_last" class="control-label col-xs-2">Last Name</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="name_last" id="name_last" placeholder="Last Name">
					</div>
				</div>
				<div class="form-group">
					<label for="title" class="control-label col-xs-2">Title/Suffix</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="title" id="title" placeholder="Title/Suffix">
					</div>
				</div>
				<div class="form-group">
					<label for="company" class="control-label col-xs-2">Company</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="company" id="company" placeholder="Company">
					</div>
				</div>
				<div class="form-group">
					<label for="address1" class="control-label col-xs-2">Address Line 1</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="address1" id="address1" placeholder="Address Line 1">
					</div>
				</div>
				<div class="form-group">
					<label for="address2" class="control-label col-xs-2">Address Line 2</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="address2" id="address2" placeholder="Address Line 2">
					</div>
				</div>
				<div class="form-group">
					<label for="city" class="control-label col-xs-2">City</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="city" id="city" placeholder="City">
					</div>
				</div>
				<div class="form-group">
					<label for="state" class="control-label col-xs-2">State</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="state" id="state" placeholder="State">
					</div>
				</div>
				<div class="form-group">
					<label for="zip" class="control-label col-xs-2">Zip Code</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="zip" id="zip" placeholder="Zip Code">
					</div>
				</div>
				<div class="form-group">
					<label for="phone_home" class="control-label col-xs-2">Home Phone</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="phone_home" id="phone_home" placeholder="Home Phone">
					</div>
				</div>
				<div class="form-group">
					<label for="phone_mobile" class="control-label col-xs-2">Mobile Phone</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="phone_mobile" id="phone_mobile" placeholder="Mobile Phone">
					</div>
				</div>
				<div class="form-group">
					<label for="phone_office" class="control-label col-xs-2">Office Phone</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="phone_office" id="phone_office" placeholder="Office Phone">
					</div>
				</div>
				<div class="form-group">
					<label for="fax" class="control-label col-xs-2">Fax Number</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="fax" id="fax" placeholder="Fax Number">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-xs-2">Email</label>
					<div class="col-xs-10">
						<input type="email" class="form-control" name="email" id="email" placeholder="Email">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-10">
						<button type="submit" class="btn btn-primary" name="submit">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>

<?php

//insert variables
	$firstName = trim($_REQUEST['name_first']);
	$middleName = trim($_REQUEST['name_middle']);
	$lastName = trim($_REQUEST['name_last']);
	$title = trim($_REQUEST['title']);
	$company = trim($_REQUEST['company']);
	$address1 = trim($_REQUEST['address1']);
	$address2 = trim($_REQUEST['address2']);
	$city = trim($_REQUEST['city']);
	$state = trim($_REQUEST['state']);
	$zip = trim($_REQUEST['zip']);
	$phoneHome = trim($_REQUEST['phone_home']);
	$phoneMobile = trim($_REQUEST['phone_mobile']);
	$phoneOffice = trim($_REQUEST['phone_office']);
	$fax = trim($_REQUEST['fax']);
	$email = trim($_REQUEST['email']);
	
	//Insert record
try{
		$insertSQL = sprintf("INSERT into members (name_first, name_middle, name_last,
		title, company, address1, address2, city, state,
		zip, phone_home, phone_mobile, phone_office, fax, email)
		VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
		'%s', '%s')",
		mysql_real_escape_string($firstName),
		mysql_real_escape_string($middleName),
		mysql_real_escape_string($lastName),
		mysql_real_escape_string($title),
		mysql_real_escape_string($company),
		mysql_real_escape_string($address1),
		mysql_real_escape_string($address2),
		mysql_real_escape_string($city),
		mysql_real_escape_string($state),
		mysql_real_escape_string($zip),
		mysql_real_escape_string($phoneHome),
		mysql_real_escape_string($phoneMobile),
		mysql_real_escape_string($phoneOffice),
		mysql_real_escape_string($fax),
		mysql_real_escape_string($email));

		
	$result = mysql_query($insertSQL);
	
	//redirect user to the page that displays user information	
header("Location: member_detail.php?memberID=" . mysql_insert_id());
exit();
	}
	catch(exception $ex){
		handle_error($ex->getMessage(), mysql_error());
	}
	
?>
