<?php
    function user_count(){
        return mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `active` = 1"), 0);
    }

    function user_data($user_id){
        $data = array();
        $user_id = (int)$user_id;

        $func_num_args = func_num_args();
        $func_get_args = func_get_args();

        //print_r($func_get_args);

        if($func_num_args > 1){
            unset($func_get_args[0]);

            $fields = '`' . implode('`, `', $func_get_args) . '`';
            //echo $fields;
            //echo "SELECT $fields FROM `users` WHERE `user_id` = $user_id";
           // die();
            $query = mysql_query("SELECT $fields FROM `users` WHERE `user_id` = $user_id");
            $data = mysql_fetch_assoc($query);

            //print_r($data);
            //die();

            return $data;
        }

    }

	function logged_in(){
		return (isset($_SESSION['user_id'])) ? true : false;
	}
	
	function user_exists($username){
		$username = sanitize($username);
        return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'"), 0) == 1);

//		$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'");
//		return(mysql_result($query, 0) == 1) ? true : false;
	}
	
	function user_active($username){
		$username = sanitize($username);

        return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `active` = 1"), 0) == 1) ? true : false;

		//$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `active`";
		//return mysql_result($query);
	}
	
	function user_id_from_username($username){
		$username = sanitize($username);
		//$query = mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'");
		return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'"), 0, 'user_id');
	}
	
	function login($username, $password){
		$user_id = user_id_from_username($username);
		$username = sanitize($username);
		$password = md5($password);
		
		$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
		return(mysql_result($query,0) == 1) ? $user_id : false;
	}
?>
