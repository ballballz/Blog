$(document).ready(function(){
	$("#btn-login").click(function(){
		validateLogin();
	});

});

function validateLogin(){
	var check_all = {};
	var check_login = $("#form-login .form-group.log input");
	var check_txt = $("#form-login .form-group.log .login-error");
	var email = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
	var is_error = false;

	$(".msg").html("");
	$(".msg").removeClass("success error");
	$(check_txt).html("")
	$(check_txt).removeClass("success error");
	$(check_login).removeClass("success-line error-line");
	
	for(var i=0;i<check_login.length;i++){
		var _ele  = $(check_login[i]).val();
		var _attr = $(check_login[i]).attr("type");

			if (_ele == "") {
				$(check_txt[i]).html("*Please enter " + _attr).addClass("error");
				is_error = true;
			} else if (_attr == "email" && !email.test(_ele)) {
				$(check_txt[i]).html("*Please format " + _attr + " valid" ).addClass("error");
				is_error = true;

			} else {
				$(check_login[i]).addClass("success-line");
			}

		check_all[_attr] = $(check_login[i]).val();
	}

		check_all['cmd'] = "login";

	if (!is_error) { 
		$.ajax({
			method: 'POST',
			url:"php/login_process.php",
			data:check_all,
	 		dataType: "json",
			success: function(data){
	    		if (data.status == "success") {		
	    			$(".msg").html("Login successfuly").addClass("success");
	    			window.location.href = "index.php";
	    		} else if (data.status == "error") {
	    			$(".msg").html("Invalid Email and Password !").addClass("error");
	    			$(check_login).addClass("error-line");
	    			is_error = false;
	    		}
	  		},
	  		error : function(error){
			    alert(error);
			} 
		})
	}
}



