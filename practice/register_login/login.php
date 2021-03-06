<?php 
	include 'core/init.php';
if(empty ($_POST) === false){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
	if(empty($username) === true || empty($password) === true) {
			$errors[] = 'You need to enter a username and password';
	}else if(user_exists($username) === false){
		$errors[] = 'Cannot find that username';
	}else if(user_active($username) === false){
		$errors[] = 'You have not activated your account';
	}else{

        if (strlen($password) > 32) {
            $errors[] = 'Password too long';
        }

        $login = login($username, $password);
		if($login === false){
			$errors[] = 'That username/password combination is incorrect';
		}else{
			//set the user session
			$_SESSION['user_id'] = $login;
			
			//redirect the user to home 
			header('Location: index.php');
			exit(); 
		}
		
	}

} else {
        $errors[] = 'No data received';
    }

include 'includes/overall/header.php';
if (empty($errors) === false){
    ?>
    <h2>we tried to log you in but...</h2>
<?php
    echo output_errors($errors);
}
include 'includes/overall/footer.php';
?>