<?php
	
	require_once 'util/SHC_config.php';
	require_once 'util/authorize.php';
	require_once 'util/dbconnect.php';
	require_once 'util/view_shc.php';
	
	
	session_start();
	
	//authorize any user, as long as they're logged in
authorize_user();
	
	$error_message = $_REQUEST['error_message'];
	
page_start("New Transaction", NULL, NULL, $error_message);
?>

	<div class="bs-example">
			<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="form-group">
					<label for="amount" class="control-label col-xs-2">Amount</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="amount" id="amount" placeholder="amount">
					</div>
				</div>
				<div class="form-group">
					<label for="amount" class="control-label col-xs-2">Date</label>
					<div class="col-xs-10">
						<input type="date" class="form-control" name="date" id="date" placeholder="Date">
					</div>
				</div>
				<div class="form-group">
					<label for="member" class="control-label col-xs-2">Member</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="member" id="member" placeholder="Member">
					</div>
				</div>
				<div class="form-group">
					<label for="purpose" class="control-label col-xs-2">Transaction Purpose</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" name="purpose" id="purpose" placeholder="Transaction Purpose">
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
	//get form values to insert to database
	
	//variables from form
	$amount = trim($_REQUEST['amount']);
	$date = trim($_REQUEST['date']);
	$member = trim($_REQUEST['member']);
	$purpose = trim($_REQUEST['purpose']);
	
//insert record
try{
	
	$insert = sprintf("INSERT into transactions (amount, date, memberID, purpose)
					VALUES ('%s', '%s', '%d', '%s')",
					mysql_real_escape_string($amount),
					mysql_real_escape_string($date),
					mysql_real_escape_string($member),
					mysql_real_escape_string($purpose));
				
				$result = mysql_query($insert);
	}
	catch(exception $ex){
		handle_error($ex->getMessage(), mysql_error());
	}
?>
