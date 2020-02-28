<!DOCTYPE html>
<html>
<head><?php require_once "head.php";?></head>
	<body>
		<div class="wrapper">			
			<header class="main-header"><?php require_once "header.php";?></header>
			<div class="alert alert-success alert-dismissible" id="errMsg" style="display:none"></div>
			<div class="main-body">
			<div>	
				<a href="javascript:void(0);" class="btn btn-primary" title="Add Student" onclick="javascript:openStudentModal();">Add Student</a>
			</div>
			<br><br>
			<div>
			<div class="input-group22 input-daterange22 pull-right">
				<span id="date-label-from" class="date-label">Date Added From: </span><input class="date-range-filter22 date" type="text" id="min"  />
				<span id="date-label -to" class="date-label">Date Added To: <input class="date-range-filter22 date" type="text" id="max"  />
			</div>
				<table id="student_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
						<thead>
							<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th><input class="form-control" type="text" id="first_name_search" name="first_name_search" placeholder="First Name"></th>
							<th><input class="form-control" type="text" id="last_name_search" name="last_name_search" placeholder="Last Name"></th>
							<th><input class="form-control" type="text" id="email_search" name="email_search" placeholder="Email"></th>
							<th><input class="form-control" type="text" id="dob_search" name="dob_search" placeholder="DOB"></th>
							<th><input class="form-control" type="text" id="phone_search" name="phone_search" placeholder="Phone"></th>
							<th><input class="form-control" type="text" id="year_joined_search" name="year_joined_search" placeholder="Year Joined "></th>
							<th colspan=3>&nbsp;</th>
							</tr>
					
							<tr>
							<th>ID</th>
							<th>Action</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>							
							<th>DOB</th>
							<th>Phone</th>
							<th>Year Joined</th>
							<th>Date Added</th>		
							<th>Class</th>
							<th>Guardian Name</th>							
							</tr>
						</thead>
				</table>
			</div>
			</div>
			<?php require_once "footer.php";?>
		</div>
		<script src="/students/public/js/home/student.js" type="text/javascript"></script>
	</body>		
</html>
