/* Get form data in key value pair base on form id */
function getFormData(id)
{
	var qryStrHash={};
	var txtId;
	var txtVal;
	$("#"+id).find(':input').each(function()
	{
		txtId  = "";
		txtVal = "";
		switch(this.type) {
			case 'text':
			case 'hidden':
			case 'email':
            case 'password':
            case 'select-multiple':
            case 'select-one':
			case 'file':
            case 'textarea':
                txtId  = this.id;
                txtVal = $(this).val();
			break;
            case 'checkbox':
				txtId  = this.id;
				if($(this).prop('checked'))
					txtVal = "yes";
			break;
            case 'radio':
				txtId  = this.name;
				txtVal = $("input[name="+this.name+"]:checked").val();
			break;
        }
		if(txtId != "")
			qryStrHash[txtId] = txtVal;
	});
	return qryStrHash;
}

/* phone number format validator */
function validateDualPhone(field, rules, i, options)
{
	if (field.val() != "") {

		var pattern =new RegExp(/^\s*(\d{1}-\d{3}-\d{3}-\d{4}|\d{3}-\d{3}-\d{4}|\(\d{3}\) \d{3}-\d{4})\s*$/);
		//var pattern =new RegExp(/^\s*(\d{1}\.\d{3}\.\d{3}\.\d{4}|\d{3}\.\d{3}\.\d{4}|\(\d{3}\) \d{3}\.\d{4}|\d{1}-\d{3}-\d{3}-\d{4}|\d{3}-\d{3}-\d{4}|\(\d{3}\) \d{3}-\d{4})\s*$/);//As per mail of 6-6-14...vishal patel
		if (!pattern.test(field.val()))
		{
			return "* Invalid Phone Number (Phone ex: 123-456-7890)";
		}
     }
}
//Auto Phone number format As US phone format
function autoPhoneNoFormat(id) {
	var phoneNo = $('#'+id).val();
	var numbers = phoneNo.replace(/\D/g, '');
    char = {0:'',3:'-',6:'-'};
    var newPhoneNo = '';
    for(var i = 0; i < numbers.length; i++) {
        newPhoneNo += (char[i]||'') + numbers[i];		
    }
	if(newPhoneNo != $('#'+id).val())
		$('#'+id).val(newPhoneNo);
}