<?php
// user model class for user operation and user login
// application/models/userModel.class.php

class UserModel extends Model{

   public function checkLoginAction($post=[]){
		
		$user_name = $password = "";
		$username_err = $password_err = "";
		// Check if user_name is empty
		if(empty(trim($post["user_name"]))){
			$username_err = "Please enter username.";
		} else{
			$user_name = trim($post["user_name"]);
		}
		
		// Check if password is empty
		if(empty(trim($post["password"]))){
			$password_err = "Please enter your password.";
		} else{
			$password = trim($post["password"]);
		}
		$password = md5($password);
		
		if(empty($username_err) && empty($password_err)){
			$where = " where user_name=? AND password=? limit 1";
			$sql = "select * from $this->table $where";
			$users = $this->db->getRow($sql,$user_name,$password);
			$cnt = count($users);
			if($cnt>0)
			{
				// Store data in session variables
				$_SESSION["user_session"]["loggedin"] = true;
				$_SESSION["user_session"]["id"] = $users['uid'];
				$_SESSION["user_session"]["username"] = $users['user_name'];        
				echo "success";
			}
			else
			{
				echo $username_err = "Incorrect credentials!";
			}
		}
		else
	    {
			echo $username_err." = ".$password_err = "";
		}

    }
}
?>