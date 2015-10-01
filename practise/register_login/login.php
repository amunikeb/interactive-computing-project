<?php 
	include 'core/init.php';
	//if(user_exists('ybalgobin') === true){
	//	echo 'exists';
	//}
	//die();
	
	if(empty ($_POST) === false){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if(empty($username) === true || empty($password) === true){
			$errors[] = 'You need to enter a username and password';
				
	}else if(user_exists($username) === false){
		$errors[] = 'Cannot find that username';
	}else if(user_active($username) === false){
		$errors[] = 'You have not activated your account';
		
	}else{
		
	}
		print_r($errors);
		//echo $username, '  ', $password;
	}
?>