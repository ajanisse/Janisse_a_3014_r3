<?php 
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL); 
	require_once('phpscripts/config.php');
//	confirm_logged_in();
	$tbl = "tbl_user";
	$users = getAll($tbl);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>CMS Portal Delete User</title>
        <link href="css/main.css" media="all" rel="stylesheet" type="text/css"/>

</head>
<body>
	<h1>Welcome Company Name to your admin page - Delete User</h1>

	<?php
		while($row = mysqli_fetch_array($users)) {
			echo "{$row['user_fname']}<a href =\"phpscripts/caller.php?caller_id=delete&id={$row['user_id']}\">Delete User</a><br>";
		}
	?>
</body>
</html>