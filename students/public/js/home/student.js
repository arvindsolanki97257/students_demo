	$(document).ready(function() {
		// Data Table Initialization
		var std_table = $('#student_table').DataTable( {
			ajax: 'index.php?p=home&c=Index&a=listStudents',
			columns: [
				{ data: "sid" },
				{ data: "sid",
					render: function ( data, type, row ) {
						return '<button class="btn btn_view" title="Click to View"><i class="fa fa-eye" ></i></button>&nbsp;<button title="Click to Edit" class="btn btn_edit"><i class="fa fa-edit" ></i></button>&nbsp;<button class="btn btn_delete" title="Click to Delete"><i class="fa fa-trash" ></i></button>';
					}
				},
				{ data: "first_name" },
				{ data: "last_name" },
				{ data: "email" },
				{ data: "dob" },
				{ data: "phone" },
				{ data: "year_joined" },
				{ data: "added_at" },
				{ data: "sclass" },
				{ data: "guardian_name" },
			],
			columnDefs:[{targets:[5,8], render:function(data){
			  return moment(data).format('MM-DD-YYYY');
			}}],
			deferRender: true,	
			language: {
				searchPlaceholder: "Search records from all columns"
			}				 
		} );
		// Data Picker Initialization
		$(".datepicker").datepicker({
			format: "mm-dd-yyyy",		
			todayHighlight:true,
			autoclose: true,	
		});

		/* Start - date range search on Date Added column */
		$('.date-range-filter22').datepicker({
			format: "mm-dd-yyyy",		
			todayHighlight:true,
			autoclose: true,
		});
		// Bootstrap datepicker
		$('.input-daterange22 input').each(function() {
		  $(this).datepicker('clearDates');
		});
		// Extend dataTables search
		$.fn.dataTable.ext.search.push(
		  function(settings, data, dataIndex) {
			var min = $('#min').val();
			var max = $('#max').val();
			var createdAt = data[8] || 8; // Our date column in the table
			if (
			  (min == "" || max == "") ||
			  (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
			) {
			  return true;
			}
			return false;
		  }
		);
		// Re-draw the table when the a date range filter changes
		$('.date-range-filter22').change(function() {
			var table = $('#student_table').DataTable();
			table.draw();
		});
		/* End - date range search on Date Added column */

		// Data Table Column wise Search 
		searchOnCol('first_name_search',std_table,2);
		searchOnCol('last_name_search',std_table,3);
		searchOnCol('email_search',std_table,4);
		searchOnCol('dob_search',std_table,5);
		searchOnCol('phone_search',std_table,6);
		searchOnCol('year_joined_search',std_table,7);
		searchOnCol('date_added_search',std_table,8);
		searchOnCol('class_search',std_table,9);
		searchOnCol('guardian_search',std_table,10);
		// View/Edit/Delete Operation call
		$('#student_table tbody').on( 'click', '.btn_edit', function () {
			var data = std_table.row( $(this).parents('tr') ).data();
			var dataObject = Object.values(data);
			var dataArray = Array.from(dataObject);	
			openStudentModal(dataArray[0],'edit');
		} );
		$('#student_table tbody').on( 'click', '.btn_view', function () {
			var data = std_table.row( $(this).parents('tr') ).data();
			var dataObject = Object.values(data);
			var dataArray = Array.from(dataObject);	
			openStudentModal(dataArray[0],'view');
		} );
		$('#student_table tbody').on( 'click', '.btn_delete', function () {
			var data = std_table.row( $(this).parents('tr') ).data();
			var dataObject = Object.values(data);
			var dataArray = Array.from(dataObject);	
			deleteStudent(dataArray[0],dataArray[1]+' '+dataArray[2]);
		} );
	} );
	/* Data Table Column wise Search */
	function searchOnCol(txtName,std_table,colNo)
	{
		$('#'+txtName).on('keyup change', function () {
			var txt_search_val = $('#'+txtName).val();
			var txt_search_len = txt_search_val.length;		
			if(txt_search_len>2)
			{
				std_table.column(colNo).search($(this).val()).draw();
			}
			else if(txt_search_len<1)
			{
				std_table.column(colNo).search($(this).val()).draw();
			}
		});		
	}
	/* Open Student Modal */
	function openStudentModal(sid,action)
	{
		var qs = {};
		if(sid != "") qs['sid'] = sid;
		qs['action']=action;
		$.ajax({
			type: 'post',
			url: 'index.php?p=home&c=Index&a=getStudentById',
			data: qs,
			success: function (res) {
				$('#studentModalContainer').html(res);
				$("#studentModal").modal();
				// Data Picker Initialization
				$(".datepicker").datepicker({
					format: "mm-dd-yyyy",		
					todayHighlight:true,
					autoclose: true,
				});
				if(action=='view')
					$("#btn_save").hide();
				$("#addEditStudentForm").validationEngine();
			},
			error: function(msg) {
				alert('Please reload the page!!!');
			}
		});
	}
	/* Add/Edit Student's Data */
	function addEditStudent(sid)
	{
		if($('#addEditStudentForm').validationEngine('validate')) {	
			qs = getFormData("addEditStudentForm");	
			if (typeof(sid) == 'undefined') 
				qs['sid'] = '';
			else
				qs['sid'] = sid;
			
			$.ajax({
				type: 'post',
				url: 'index.php?p=home&c=Index&a=addEditStudent',
				data: qs,
				success: function (data) {	

						data = data.trim()
						if(data =="duplicate_email")
						{							
							$(".error_span_msg").show();
							return false;
						}
						if (typeof(sid) == "undefined")
						{
							$("#studentModal").modal('hide');
							$("html, body").animate({ scrollTop: 0 }, "slow");
							$("#errMsg").html('Student has been Added successfully!');
							$("#errMsg").fadeTo(5000, 500).slideUp(500, function(){
								$("#errMsg").slideUp(2000);
							});									
						}
						else
						{
							$("#studentModal").modal('hide');
							$("html, body").animate({ scrollTop: 0 }, "slow");
							$("#errMsg").html('Student has been Updated successfully!');
							$("#errMsg").fadeTo(5000, 500).slideUp(500, function(){
								$("#errMsg").slideUp(2000);
							});
						}
						$('#student_table').DataTable().ajax.reload();					
				},
				error: function(msg) {
					alert('Please reload the page!!!');
				}
			});
		}
	}
	/* Delete Student's Data */
	function deleteStudent(sid,full_name){
		var conf = confirm("Are you sure your want to delete "+full_name);
		if (conf == true) {
			var qs = {};
			if(sid != "") qs['sid'] = sid;
			$.ajax({
				type: 'post',
				url: 'index.php?p=home&c=Index&a=deleteStudentById',
				data: qs,
				success: function (res) {
					if(res)
					{
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$("#errMsg").html('Student has been Deleted successfully!');
						$("#errMsg").fadeTo(5000, 500).slideUp(500, function(){
							$("#errMsg").slideUp(2000);
						});
						$('#student_table').DataTable().ajax.reload();
					}
				},
				error: function(msg) {
					alert('Please reload the page!!!');
				}
			});
		} 
	}
