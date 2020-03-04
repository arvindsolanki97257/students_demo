<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="robots" content="noindex,nofollow">
<title>JRD GROUP</title>
<link href="/students/public/css/login.css" rel="stylesheet" type="text/css" />
<link href="/students/public/css/4.1.3-bootstrap.css" rel="stylesheet" type="text/css" />
<script src="/students/public/js/jquery-3.3.1.js" type="text/javascript"></script>
<script src="/students/public/js/4.4.1-bootstrap.min.js" type="text/javascript"></script>
<script src="/students/public/js/validation/btvalidationEngine-en.js" type="text/javascript"></script>
<script src="/students/public/js/validation/btvalidationEngine.js" type="text/javascript"></script>
<script src="/students/public/js/common.js" type="text/javascript"></script>

</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <div class="fadeIn first"><br><strong>JRD GROUP LOGIN</strong><br></div>
    <form id="loginForm" name='loginForm' action="javascript:void(0);">
      <input type="text" id="user_name" class="fadeIn second validate[required]" name="user_name" placeholder="User Name">
      <input type="password" id="password" class="fadeIn third validate[required]" name="password" placeholder="Password">
      <input type="button" class="fadeIn fourth" value="Log In" id="btn_login" onclick="loginFormSubmit()">
    </form>
	<div class="login_error" style="display:none;">Incorrect credentials!</div>
  </div>
</div>

<script>
	$(document).ready(function(){
		$("#loginForm").validationEngine();
		$("#user_name").keypress(function(event) {
			if(event && event.keyCode == 13) {
				loginFormSubmit();
			}
		});
		$("#password").keypress(function(event) {
			if(event && event.keyCode == 13) {
				loginFormSubmit();
			}
		});

	});
	function loginFormSubmit()
	{
		$(".login_error").hide();
		if($('#loginForm').validationEngine('validate')) {	
			qs = getFormData("loginForm");	
		
			$.ajax({
				type: 'post',
				url: 'index.php?p=admin&c=Login&a=login',
				data: qs,
				success: function (res) {
					
					if(res=="Incorrect credentials!")
					{
						$(".login_error").show();
					}
					else if(res=="success")
					{
						window.location.replace("index.php?p=admin&c=Index&a=index");
					}
				},
				error: function(msg) {
					alert('Please reload the page!!!');
				}
			});
		} 
	}
</script>

</body>
</html>