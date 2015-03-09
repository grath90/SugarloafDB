<?php
/* Cole Rath 2/26
--This page will show all members in the db
*/
 	
 	require_once 'util/SHC_config.php';
 	require_once 'util/authorize.php';
 	require_once 'util/dbconnect.php';
 	require_once 'util/view_shc.php';
 	
 	
 	session_start();
	//authorize any user, as long as they're logged in
	
authorize_user();
	
	$error_message = $_REQUEST['error_message'];
 	
 	//select query to display all members
 	$select_query = "SELECT memberID, name_first, name_last, email " .
 					" FROM members;";
 	//execute query
 	$result = mysql_query($select_query);

 	
page_start("All Members", NULL, NULL, $error_message);
	
?>

	<div class="bs-example">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Member ID</th>
					<th>First Name</th>
					<th>Last name</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody data-link="row" class="rowlink">
				<?php
					while($user = mysql_fetch_array($result)){
						$user_row = sprintf("<tr>" . 
												"<td><a href='member_detail.php?memberID=%d'>%d</a></td>" . 
												"<td>%s</td>" . 
												"<td>%s</td>" . 
												"<td>%s</td>" . 
											"</tr>",
										$user['memberID'],
										$user['memberID'], 
										$user['name_first'], 
										$user['name_last'], $user['email']);
										echo $user_row;
						}
				?>
				</tbody>
			</table>
		</div>
	</body>
</html>
