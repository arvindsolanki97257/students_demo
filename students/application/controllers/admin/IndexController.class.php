<?php

// Backend Index Controller

class IndexController extends Controller{

	function __construct(){ 

		// Check if the user is logged in, if not then redirect to login page
		if(!isset($_SESSION["user_session"]["loggedin"])) {
			header("location: index.php?p=admin&c=Login&a=index");
			exit;
		}
	}

	// index method - call after successfull login.
    public function indexAction(){

        include  CURR_VIEW_PATH . "content.php";
    }
	
	// get all students from DB and send to datatable
    public function listStudentsAction(){		

		$studentModel = new StudentModel(JRD_STUDENTS);
        $users_arr = $studentModel->getStudents();
		$users_res['data'] = $users_arr;
		$user_json=json_encode($users_res);
		echo $user_json;
    }
	
	// add/edit student by id
	public function addEditStudentAction(){
		$studentModel = new StudentModel(JRD_STUDENTS);
        $sid = $studentModel->addEditStudent($_POST);
		echo $sid;
	}

	// delete student by id
	public function deleteStudentByIdAction(){
		$studentModel = new StudentModel(JRD_STUDENTS);
        $sid = $studentModel->deleteStudent($_POST);
		echo $sid;	
	}

	// get student data by sid 
	public function getStudentByIdAction(){	
		
		$file = CURR_VIEW_PATH."studentDialog.php";
		$fp = fopen($file ,"r");
		$fileContent = fread($fp, filesize($file));
		fclose($fp);
		$disbled_flg='';
		if(!empty($_POST['action']))
			$disbled_flg = ($_POST['action']=='view')?'disabled':'';
		if(!empty($_POST['sid'])) {

			$studentModel = new StudentModel(JRD_STUDENTS);
			$users_arr = $studentModel->getStudents($_POST);
			if(!empty($users_arr[0]['dob']))
				$dob=date("m-d-Y",strtotime($users_arr[0]['dob']));
			else
				$dob='';
			$modalTitleText = ($_POST['action']=='view')?'View Student':'Edit Student';
			$fileContent = str_replace("{modal_title}",$modalTitleText,$fileContent);
			$fileContent = str_replace("{disabled_input}",$disbled_flg,$fileContent);
			$fileContent = str_replace("{sid}",$users_arr[0]['sid'],$fileContent);	
			$fileContent = str_replace("{first_name}","value='".$users_arr[0]['first_name']."'",$fileContent);	
			$fileContent = str_replace("{last_name}","value='".$users_arr[0]['last_name']."'",$fileContent);	
			$fileContent = str_replace("{email}","value='".$users_arr[0]['email']."'",$fileContent);	
			$fileContent = str_replace("{phone}","value='".$users_arr[0]['phone']."'",$fileContent);	
			$fileContent = str_replace("{dob}","value='".$dob."'",$fileContent);	
			$fileContent = str_replace("{sclass}","value='".$users_arr[0]['sclass']."'",$fileContent);	
			$fileContent = str_replace("{guardian_name}","value='".$users_arr[0]['guardian_name']."'",$fileContent);	
			$fileContent = str_replace("{year_joined}","value='".$users_arr[0]['year_joined']."'",$fileContent);
		}
		else
		{			
			$fileContent = str_replace("{modal_title}","Add Student",$fileContent);	
			$fileContent = str_replace("{disabled_input}",$disbled_flg,$fileContent);
			$fileContent = str_replace("{sid}",'',$fileContent);	
		}
		echo  $fileContent;
    }

	public function exportCsvAction()
	{

		$studentModel = new StudentModel(JRD_STUDENTS);
        $users_arr = $studentModel->getStudents();
		
		$fileName = "StudentsData".date("Y-m-d-H:i:s");
		$isCsv=$_REQUEST['type'];
		if($isCsv==1) 
		{
			header("Content-Disposition: attachment; filename=".$fileName.".csv"); 
		} 
		else 
		{
			header("Content-Disposition: attachment; filename=".$fileName.".xls"); 
		}

		$seprator = "\t";
		if($isCsv==1)
		{
			$seprator = ",";
		}

		header("Content-Type: application/vnd.ms-excel");
		
		$header = "First Name".$seprator."Last Name".$seprator."DOB".$seprator."Email".$seprator."Class".$seprator."Guardian Name".$seprator."Phone".$seprator."Year Joined".$seprator."Date Added".$seprator."Date Updated";
		$header .= "\n\n";
		echo $header;
		foreach($users_arr as $res)
		{
			echo $res['first_name'].$seprator.$res['last_name'].$seprator.$res['dob'].$seprator.$res['email'].$seprator.$res['sclass'].$seprator.$res['guardian_name'].$seprator.$res['phone'].$seprator.$res['year_joined'].$seprator.$res['added_at'].$seprator.$res['updated_at']."\n";
		}
		exit;
	}

}
?>