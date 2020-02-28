<?php
/* A = Admin */

$access = array
(
	// For Backend
	"admin_IndexController" => array
	(
		"indexAction" => array("A"),
		"listStudentsAction" => array("A"),
		"addEditStudentAction" => array("A"),
		"deleteStudentByIdAction" => array("A"),
		"getStudentByIdAction" => array("A"),
		"exportCsvAction"=>array("A")
	),
	"admin_LoginController" => array
	(
		"indexAction" => array("A"),
		"loginAction" => array("A"),
		"logoutUserAction" => array("A"),
		"forgotPassAction" => array("A"),
		"changePassAction" => array("A"),
	),

	// For Frontend 
	"home_IndexController" => array
	(
		"indexAction" => array("A"),
		"listStudentsAction" => array("A"),
		"addEditStudentAction" => array("A"),
		"deleteStudentByIdAction" => array("A"),
		"getStudentByIdAction" => array("A"),
	),
);
$GLOBALS["access"] =$access;
?>