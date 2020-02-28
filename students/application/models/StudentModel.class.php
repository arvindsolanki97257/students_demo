<?php

// Student model class for basic operation on students
// application/models/studentModel.class.php

class StudentModel extends Model{

   // get student details. return single row if sid is set other wise all rows.
   public function getStudents($post=[]){
		
		$where='';
		if(!empty($post["sid"])) {
			$where = " where sid=".$post['sid'];
		}
		$sql = "select * from $this->table $where order by sid desc";

        $users = $this->db->getAll($sql);

        return $users;

    }

   // add/edit student's data
   public function addEditStudent($post=[]){
		
		$data=$post;
		if(!empty($post["dob"])) {
			$post['dob'] = str_replace("-","/",$post['dob']);
			$data['dob'] = date("Y-m-d",strtotime($post['dob']));
		}
		$data["updated_at"] = date("Y-m-d h:i:s");

		// insert new student
		if(empty($post['sid']))
		{
			$data["added_at"]   = date("Y-m-d h:i:s");

			$where='';
			if(!empty($post["email"])) {
				$where = " where email='".$post['email']."'";
			}
			$sql = "select * from $this->table $where";
			$users = $this->db->getAll($sql);
			if(count($users)>0)
			{
				return "duplicate_email";
			}
			else
			{
				$sid = $this->insertData($data);
				return $sid;
			}
		}
		// update existing student
		else
		{
			$where='';
			if(!empty($post["email"])) {
				$where = " where email='".$post['email']."' AND sid !=".$post['sid'];
			}
			$sql = "select * from $this->table $where";
			$users = $this->db->getAll($sql);
			if(count($users)>0)
			{
				return "duplicate_email";
			}
			else
			{
				$sid = $this->updateData($data);
				return $sid;
			}
		}
    }
	
	// hard delete student
	public function deleteStudent($post=[]){

		if(!empty($post["sid"])) {
			$sid = $this->deleteData($post["sid"]);
			return $sid;
		}
	}

	// soft delete student
	public function softDeleteStudent($post=[]){

		$data["deleted_at"] = date("Y-m-d h:i:s");
		$data["sid"] = $post["sid"];
		$sid = $this->updateData($data);
		return $sid;
	}
}
?>