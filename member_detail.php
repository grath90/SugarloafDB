<?php
require_once 'util/dbconnect.php';
require_once 'util/SHC_config.php';
require_once 'util/view_shc.php';
require_once 'util/authorize.php';

	session_start();
	
	authorize_user();

$error_message = $_REQUEST['error_message'];
//get user id from member_all.php

$memberID = $_REQUEST['memberID'];

//select query to get member info
$select_member = sprintf("SELECT * FROM members WHERE memberID = %d",
					mysql_real_escape_string($memberID));
					
$result_member = mysql_query($select_member);
//select query to get members transactions. could be done in one query but moved to two
//queries to make it easier to display info. 


//get the query arrays 
$member = mysql_fetch_array($result_member);

//member results
$name_first = $member['name_first'];
$name_middle = $member['name_middle'];
$name_last = $member['name_last'];
$full_name = $name_first . " " . $name_middle . " " . $name_last;
$title = $member['title'];
$company = $member['company'];
$address1 = $member['address1'];
$address2 = $member['address2'];
$city = $member['city'];
$state = $member['state'];
$zip = $member['zip'];
$full_address = $address1 . " " . $address2 . " " . $city . "," . $state . " " . $zip;
$phone_home = $member['phone_home'];
$phone_mobile = $member['phone_mobile'];
$phone_office = $member['phone_office'];
$fax = $member['fax'];
$email = $member['email'];

//get transactions for member				
$select_transaction = sprintf("SELECT * FROM transactions WHERE memberID = %d",
								mysql_real_escape_string($memberID));

$result_transaction = mysql_query($select_transaction);					
					
page_start("Member Details", NULL, NULL, $error_message);


?>

	<div class="bs-example">
		<div class="col-md-4">
		<!--Member Details Table-->
			<table class="table table-bordered">
			<thead><b>Member Details</b></thead>
				<tbody>
					<tr>
            			<th scope="row">Name</th>
            			<td><?php echo $full_name; ?></td>
        			</tr>
       				 <tr>
            			<th scope="row">Title</th>
            			<td><?php echo $title; ?></td>
       				 </tr>
        			<tr>
            			<th scope="row">Company</th>
           				<td><?php echo $company; ?></td>
        			</tr>
        			<tr>
           	 			<th scope="row">Address</th>
            			<td><?php echo $full_address; ?></td>
            		</tr>
            		<tr>
           	 			<th scope="row">Home Phone</th>
            			<td><?php echo $phone_home; ?></td>
            		</tr>
            		<tr>
           	 			<th scope="row">Mobile Phone</th>
            			<td><?php echo $phone_mobile; ?></td>
            		</tr>
            		<tr>
           	 			<th scope="row">Office Phone</th>
            			<td><?php echo $phone_office; ?></td>
            		</tr>
            		<tr>
           	 			<th scope="row">Fax</th>
            			<td><?php echo $fax; ?></td>
            		</tr>
            		<tr>
           	 			<th scope="row">Email</th>
            			<td><?php echo $email; ?></td>
            		</tr>
            	</tbody>
            </table>
        </div>
		<!--Member Transactions Table-->
			<div class="col-md-4">
			<table class="table table-bordered">
				<thead><b>Member Transactions</b>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>Purpose</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($transaction = mysql_fetch_array($result_transaction)){
								$xaction_row = sprintf("<tr>" .
															"<td>%s</td>" . 
															"<td>%s</td>" . 
															"<td>%s</td>" .
														"</tr>",
											$transaction['date'], $transaction['amount'], 
											$transaction['purpose']);
											echo $xaction_row;					
								}
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>		
