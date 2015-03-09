<?php

	require_once 'util/SHC_config.php';
	require_once 'util/dbconnect.php';
 	require_once 'util/authorize.php';
 	require_once 'util/view_shc.php';
 	
 	session_start();
 	
 	authorize_user();
 	
 	page_start("Home");
?>
		<div class="jumbotron">
			<div class="container-fluid">
				<h1>Home Menu</h1>
			</div>
		</div>
		<div class="container-fluid">
		
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3">
					<p><a href="member_all.php" class="btn btn-success">All Members</a></p>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<p><a href="transaction_all.php" class="btn btn-success">All Transactions</a></p>
				</div>
			</div>
			<div class="row">
				<div class="clearfix visible-sm-block"></div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<p><a href="member_new.php" class="btn btn-success">New Member</a></p>
				</div>
				<div class=clearfix visible-md-block">
				<div class="col-sm-6 col-md-4 col-lg-3">
					<p><a href="construction.html" class="btn btn-success">New Transaction</a></p>
				</div>
			</div>
		</div>			
	</body>
</html>
