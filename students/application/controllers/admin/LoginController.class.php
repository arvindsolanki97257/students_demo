<?php

// login controller 
// application/controllers/admin/LoginController.class.php

class LoginController extends Controller{

    public function indexAction(){
		
		// Unset all of the session variables when login page load.
		$_SESSION = array();		 
		// Destroy the session when login page load.
		session_destroy();

        include  CURR_VIEW_PATH . "login.php";
    }

    public function loginAction(){		
		$userModel = new UserModel(JRD_USERS);
		$sid = $userModel->checkLoginAction($_POST);
    }
	public function logoutUserAction(){

		// Unset all of the session variables
		$_SESSION = array();
		 
		// Destroy the session.
		session_destroy();
		echo "success";
	}
	public function forgotPassAction(){

		// forgot users' password code

	}
	public function changePassAction(){

		// change user's password code 

	}
}
?>