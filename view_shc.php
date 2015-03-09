<?php
	require_once 'SHC_config.php';
	require_once 'authorize.php';
	
	define("SUCCESS_MESSAGE", "success");
	define("ERROR_MESSAGE", "error");

	session_start();	
		
function display_messages($success_msg = NULL, $error_msg = NULL) {
		echo "<div id='messages'>\n";
		if (!is_null($success_msg) && (strlen($success_msg) > 0)){
			display_message($success_msg, SUCCESS_MESSAGE);
		}
		if (!is_null($error_msg) && (strlen($error_msg) > 0)){
			display_message($error_msg, ERROR_MESSAGE);
		}
		echo "</div>\n\n";
	}
	
function display_message($msg, $msg_type) {
		echo " <div class='{$msg_type}'>\n";
		echo "  <p>{$msg}</p>\n";
		echo " </div>\n";
	}
	
function display_head($page_title = "", $embedded_javascript = NULL) {
 echo <<<EOD
	<html>
		<head>
			<link href="bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
			<link href="bootstrap-3.3.2-dist/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
			<link href="bootstrap-3.3.2-dist/css/jasny-bootstrap.min.css" rel="stylesheet" />
			<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
			<script type="text/javascript" src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
   			<script type="text/javascript" src="js/jquery.validate.min.js"></script>
   			<script type="text/javascript" src="js/jquery.validate.password.js"></script>
   			<script type="text/javascript" src="js/jasny-bootstrap.min.js"></script>
			<style type="text/css">
				.bs-example{
					margin: 20px;
					padding-top: 50px;
			}
			/* fix alignment issue of label on extra small devices in Bootstrap 3.2 */
			.form-horizontal .control-label{
				padding-top: 7px;
			}
		</style>
EOD;
		if(!is_null($embedded_javascript)) {
			echo "<script type='text/javascript'>" . 
				$embedded_javascript . 
				"</script>";
		}
		echo " </head>";
	}
	
	function display_head_buried($page_title = "", $embedded_javascript = NULL) {
 echo <<<EOD
	<html>
		<head>
			<link href="../bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
			<link href="../bootstrap-3.3.2-dist/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
			<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
			<script type="text/javascript" src="../bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
   			<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
   			<script type="text/javascript" src="../js/jquery.validate.password.js"></script>
			<style type="text/css">
				.bs-example{
					margin: 20px;
					padding-top: 50px;
			}
			/* fix alignment issue of label on extra small devices in Bootstrap 3.2 */
			.form-horizontal .control-label{
				padding-top: 7px;
			}
		</style>
EOD;
		if(!is_null($embedded_javascript)) {
			echo "<script type='text/javascript'>" . 
				$embedded_javascript . 
				"</script>";
		}
		echo " </head>";
	}

	
function display_title($title, $success_msg = NULL, $error_msg = NULL) {
	echo <<<EOD
		<body>
		<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    		<div class="container-fluid">
        		<div class="navbar-header">
            		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
                		<span class="sr-only">Toggle navigation</span>
                		<span class="icon-bar"></span>
                		<span class="icon-bar"></span>
                		<span class="icon-bar"></span>
                		<span class="icon-bar"></span>
            		</button>
            		<a class="navbar-brand" href="home.php">Sugarloaf Heritage Council</a>
        		</div>
        <!-- Collect the nav links, forms, and other content for toggling -->
EOD;
	if(isset($_SESSION['user_id'])) {
		echo <<<EOD
		<div class="collapse navbar-collapse" id=navbarCollapse">
			<ul class="nav navbar-nav">
				<li><a href="home.php">Home</a></li>
EOD;
		if (user_in_group($_SESSION['user_id'], "admin")){
			echo "<li><a href='user.php'>Admin</a></li>";
			}
		echo "<li><a href='util/sign_out.php'>Sign Out</a></li>";
	}else{
		echo "<li><a href='util/sign_in.php'>Sign In</a></li>";
	}
	echo <<<EOD
			</ul>
		</div>
	</div>
	</nav>
EOD;
		
	display_messages($success_msg, $error_msg);
	}

function display_title_buried($title, $success_msg = NULL, $error_msg = NULL) {
	echo <<<EOD
		<body>
		<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    		<div class="container-fluid">
        		<div class="navbar-header">
            		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
                		<span class="sr-only">Toggle navigation</span>
                		<span class="icon-bar"></span>
                		<span class="icon-bar"></span>
                		<span class="icon-bar"></span>
                		<span class="icon-bar"></span>
            		</button>
            		<a class="navbar-brand" href="home.php">Sugarloaf Heritage Council</a>
        		</div>
        <!-- Collect the nav links, forms, and other content for toggling -->
EOD;
	if(isset($_SESSION['user_id'])) {
		echo <<<EOD
		<div class="collapse navbar-collapse" id=navbarCollapse">
			<ul class="nav navbar-nav">
				<li><a href="../home.html">Home</a></li>
EOD;
		if (user_in_group($_SESSION['user_id'], "admin")){
			echo "<li><a href='user.php'>Admin</a></li>";
			}
		echo "<li><a href='sign_out.php'>Sign Out</a></li>";
	}else{
		echo "<li><a href='sign_in.php'>Sign In</a></li>";
	}
	echo <<<EOD
			</ul>
		</div>
	</div>
	</nav>
EOD;
		
	display_messages($success_msg, $error_msg);
}
function page_start($title, $javascript = NULL, 
			$success_message = NULL, $error_message = NULL){
	
	display_head($title, $javascript);
	display_title($title, $success_message, $error_message);
}

function page_start_buried($title, $javascript = NULL, 
			$success_message = NULL, $error_message = NULL){
	
	display_head_buried($title, $javascript);
	display_title_buried($title, $success_message, $error_message);
}

?>
