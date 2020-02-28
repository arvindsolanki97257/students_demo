<!-- Start - Modal -->
<div class="modal" id="studentModal">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
  
	<!-- Modal Header -->
	<div class="modal-header">
	  <h4 class="modal-title">{modal_title}</h4>
	  <span class="error_span_msg" style="display:none"> &nbsp;&nbsp;&nbsp;*Error : Duplicate Email - Student with same Email exist!</span>
	  <button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	
	<!-- Modal body -->
	<div class="modal-body">
		<form  id="addEditStudentForm" name='addEditStudentForm' action="javascript:void(0);">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label>First Name <span class="requiredField">*</span></label> 
						<input maxlength="20" type="text" id="first_name" name='first_name' class="form-control validate[required]" {first_name}  {disabled_input}>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label>Last Name <span class="requiredField">*</span></label>  
						<input maxlength="20" type="text" id="last_name" name="last_name" class="form-control validate[required]" {last_name} {disabled_input}>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label>Email <span class="requiredField">*</span></label> <span class="error_span_msg" style="display:none"> Duplicate Email</span>
						<input maxlength="40" type="text" id="email" name='email' class="form-control validate[required,custom[email]]" {email} {disabled_input}>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label>Phone number <span class="requiredField">*</span></label> 
						<input type="text" id="phone" name='phone' class="form-control validate[required,custom[phone]],funcCall[validateDualPhone]" onkeyup="autoPhoneNoFormat(this.id);" maxlength='12' {phone} {disabled_input}>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label>Date Of Birth <span class="requiredField">*</span></label>  								
						<input maxlength="20" type="text" id="dob" name="dob" class="form-control datepicker validate[required]" {dob} {disabled_input}>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label>Class <span class="requiredField">*</span></label> 
						<input maxlength="20" type="text" id="sclass" name='sclass' class="form-control validate[required]" {sclass} {disabled_input}>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label>Guardian Name <span class="requiredField">*</span></label>  
						<input maxlength="20" type="text" id="guardian_name" name="guardian_name" class="form-control validate[required]" {guardian_name} {disabled_input}>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label>Year Joined <span class="requiredField">*</span></label>  
						<input maxlength="6" type="text" id="year_joined" name="year_joined"  class="form-control validate[required]" {year_joined} {disabled_input}>&nbsp;<span class="err_msg" id="err_msg"></span>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<!-- Modal footer -->
	<div class="modal-footer">
	  <button type="submit" class="btn btn-primary" onClick="addEditStudent({sid});" title="Save" id="btn_save">Save</button>
	  <button type="button" class="btn btn-danger" data-dismiss="modal"addEditStudent>Close</button>
	</div>
	
  </div>
</div>
</div>
<!-- End - Modal -->
<script>
$(document).ready(function() {
	  $("#year_joined").keypress(function (e) {
		 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			$("#err_msg").html("Allow Digits Only!").show().fadeOut("slow");
				   return false;
		}
	   });
});
</script>