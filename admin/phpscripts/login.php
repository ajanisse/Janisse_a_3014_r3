<?php

	function logIn($username, $password, $ip) {
		require_once('connect.php');
		$username = mysqli_real_escape_string($link,$username);
		$password = mysqli_real_escape_string($link,$password);
		$loginstring = "SELECT * FROM tbl_user WHERE user_name = '{$username}' AND user_pass = '{$password}'";

		$user_set = mysqli_query($link, $loginstring);
//        Pseudo-code layout
//        if (user_firstLogin = 1)
//                redirect to edit
//                change user_firstLogin to 2
//        else if
//                redirect to admin
//        else
////              error msg
//        
//        
        
		if(mysqli_num_rows($user_set)){
			$found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
			$id = $found_user['user_id'];
			$_SESSION['user_id'] = $id;
			$_SESSION['user_name'] = $found_user['user_fname'];
            
            //grab userFirstLogin from user table in db using a query
            $firstLoginString = "SELECT userFirstLogin FROM tbl_user WHERE user_id='{$id}'";
            //store it in a query
			$firstLoginQuery = mysqli_query($link, $firstLoginString);
            //Turn it into an array using MYSQLI_ASSOC
            //Found Here : http://php.net/manual/en/mysqli-result.fetch-array.php
			$found_userArray = mysqli_fetch_array($firstLoginQuery, MYSQLI_ASSOC);
            //declare it as a bool variable, to increment it
			$firstLogin = $found_userArray['userFirstLogin'];
		
			if(mysqli_query($link, $loginstring) && ($firstLogin == 1)) {
                //if $loginstring AND if firstLogin is still 1, then
				$updatestring = "UPDATE tbl_user SET user_ip = '$ip' WHERE user_id='{$id}'";
                //This sets the bool to false in the userFirstLogin column
				$updatestring = "UPDATE tbl_user SET userFirstLogin = 2 WHERE user_id='{$id}'"; 
				$updatequery = mysqli_query($link, $updatestring);
                //edit, once the user has incremented the userFirstLogin, then redirect to Edit User 
				redirect_to("admin_editUser.php");
			}elseif(mysqli_query($link, $loginstring) && ($firstLogin == 2)) { 
                //if $loginstring AND if firstLogin is now 2, then
				$updatestring = "UPDATE tbl_user SET user_ip = '$ip' WHERE user_id='{$id}'";
				$updatequery = mysqli_query($link, $updatestring);
                //Redirect to index from now on, since the userFirstLogin is 2 
				redirect_to("admin_index.php"); 
			}else{
				$message = "The username or password is incorrect.";
				return $message;
		}
			echo $id;
		  mysqli_close($link);
	}
            
            
            
            
            
    }
            


?>