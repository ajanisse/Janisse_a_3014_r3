<?php 
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);

	require_once('phpscripts/config.php');

	$ip = $_SERVER['REMOTE_ADDR'];
	//echo $ip;
	if(isset($_POST['submit'])){
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	if($username !== "" && $password !== "") {
		
		$result = login($username, $password, $ip);
		$message = $result;
	}else{
		$message = "Please fill in the required fields";
		
	}
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
	<h1>Welcome Company Name</h1>
    <br><br>
    <h1>Enter your Login Credentials Below</h1>
	<?php if(!empty($message)){echo $message;}?>
	<form action="admin_login.php" method="post">
		<label>Username:</label>
		<input type="text" name="username" value="">
		<br>
		<label>Password:</label>
		<input type="text" name="password" value="">
		<br>
		<input type="submit" name="submit" value="Ok, Log in!">
	</form>
</body>
</html>