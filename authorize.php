<?php
	require_once 'dbconnect.php';
	require_once 'SHC_config.php';
	
	session_start();
	
function authorize_user($groups = NULL){
// NO NEED TO CHECK GROUPS IF THE USER_ID IN THE SESSION ISN'T SET

	if((!isset($_SESSION['user_id'])) || (!strlen($_SESSION['user_id']) > 0)){
		header('Location: util/sign_in.php?error_message=You must login to see this page.');
		exit;
	}
	
	//if no groups passed in, the authorization above is enough
	if((is_null($groups)) || (empty($groups))){
		return;
	}
	
	
//set up the query string
	$query_string = "SELECT ug.user_id" .
	" FROM user_groups ug, groups g" . 
	" WHERE g.name = '%s'" . 
	"  AND g.id = ug.group_id" . 
	"  AND ug.user_id = " . mysql_real_escape_string($_SESSION['user_id']);
	
//run through each group and check membership
	foreach($groups as $group){
		$query = sprintf($query_string, mysql_real_escape_string($group));
		$result = mysql_query($query);
		
		if(mysql_num_rows($result) == 1){
			//if we got a result, the user should be allowed access
			//just return so the script will continue to run
			return;
		}
	}
	
	//if we got here, no matches were found for any group
	//the user isn't allowed access
	handle_error("You are not authorized to see this page.");
	exit;
	
}

function user_in_group($user_id, $group) {
  $query_string =
    "SELECT ug.user_id" .
    "  FROM user_groups ug, groups g" .
    " WHERE g.name = '%s'" .
    "   AND g.id = ug.group_id" .
    "   AND ug.user_id = %d";
  $query = sprintf($query_string, mysql_real_escape_string($group), 
                                  mysql_real_escape_string($user_id));
  $result = mysql_query($query);

  if (mysql_num_rows($result) == 1) {
    return true;
  } else {
    return false;
  }
}

?>
