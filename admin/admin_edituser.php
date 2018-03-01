<?php 
	require_once('phpscripts/config.php');

	$id = $_SESSION['user_id'];
	//echo $id;
	$tbl = "tbl_user";
	$col = "user_id";
	$popForm = getSingle($tbl, $col, $id);
	$found_user = mysqli_fetch_array($popForm, MYSQLI_ASSOC);
	


	if(isset($_POST['submit'])) {
		$fname = trim($_POST['fname']);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$email = trim($_POST['email']);
		$result = editUser($id, $fname, $username, $password, $email);
		$message = $result;
		


	}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>CMS Portal Login</title>
<link href="css/main.css" media="all" rel="stylesheet" type="text/css"/>

</head>
<body>
	<h1>Welcome Company Name to your Edit user page</h1>
	<?php if(!empty($message)){echo $message;} ?>
	<form action="admin_edituser.php" method="post">
	<label>First Name:</label>
	<input type="text" name="fname" value="<?php echo $found_user['user_fname'];?>"><br><br>
	<label>Username:</label>
	<input type="text" name="username" value="<?php echo $found_user['user_name'];?>"><br><br>
	<label>Password:</label>
	<input type="text" name="password" value="<?php echo $found_user['user_pass'];?>"><br><br>
	<label>Email:</label>
	<input type="text" name="email" value="<?php echo $found_user['user_email'];?>"><br><br>
	<br><br>
	<input type ="submit" name="submit" value="Edit User">


	</form>
</body>
</html>