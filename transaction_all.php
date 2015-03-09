<?php
/* Cole Rath 2/26
--This page will show all transactions in the db
*/
 	
 	require_once 'util/SHC_config.php';
 	require_once 'util/authorize.php';
 	require_once 'util/dbconnect.php';
 	require_once 'util/view_shc.php';
 	
 	
 	session_start();
 	
 	authorize_user();
 	
 	$error_message = $_REQUEST['error_message'];
 	
 	//build the select statement
 	$select_xactions = "SELECT t.transactionID, t.amount, t.memberID, t.purpose," .
 						"m.name_first, m.name_last " . 
 						" FROM transactions t, members m" . 
 						" WHERE t.memberID = m.memberID;";
 	//execute query
 	$result = mysql_query($select_xactions);
 	
page_start("All Transactions", NULL, NULL, $error_message);

?>

<div class="bs-example">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Amount</th>
					<th>Purpose</th>
					<th>First Name</th>
					<th>Last Name</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while($xaction = mysql_fetch_array($result)){
						$xaction_row = sprintf("<tr>" . 
												"<td>%s</td>" . 
												"<td>%s</td>" . 
												"<td>%s</td>" . 
												"<td>%s</td>" . 
											"</tr>",
										$xaction['amount'], $xaction['purpose'],
										$xaction['name_first'], $xaction['name_last']);
										echo $xaction_row;
						}
				?>
				</tbody>
			</table>
		</div>
	</body>
</html>
