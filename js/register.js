$(document).ready(function(){
	$("#btn-register").click(function(){
		validateRegister();
	});
});

function validateRegister(){
	var check_all = {};
	var check_regis = $("#form-register .form-group.reg input");
	var check_txt = $("#form-register .form-group.reg .regis-error");
	var email = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
	var is_error = false;

	$(".msg").html("");
	$(".msg").removeClass("error");
	$(check_txt).html("");
	$(check_txt).removeClass("success error");
	$(check_regis).removeClass("success-line error-line")

	for (var i=0;i<check_regis.length;i++){
		var _ele = $(check_regis[i]).val();
		var _attr = $(check_regis[i]).attr("data-type");

		if (_ele == "") {
			$(check_txt[i]).html("*Please enter " + _attr).addClass("error");
			is_error = true;

		} else if (_attr == "password" && _ele.length < 8) {
			$(check_txt[i]).html("*Please enter " + _attr + " more than").addClass("error");
			is_error = true;

		} else if (_attr == "email" && !email.test(_ele)) {
			$(check_txt[i]).html("*Please format " + _attr + " valid").addClass("error");
			is_error = true;

		} else {
			$(check_regis[i]).addClass("success-line");
		}

		check_all[_attr] = $(check_regis[i]).val();
	}

	check_all['cmd'] = "register";

	if (!is_error) {
		$.ajax({
			method: 'POST',
			url: "php/register_process.php",
			data:check_all,
	 		dataType: "json",
			success: function(data){
	    		if (data.status == "success") {
	    			$(".alert").html("<h1>Register successfuly</h1><h3>Your account is creted!</h3>");
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'Register successfuly',
						showConfirmButton: false,
						timer: 1500
					  },window.setTimeout(function(){
						window.location.href = "login.php";
						}, 2000))
	    			is_error = false;
	    		}else if (data.status == "error"){
	    			$(".msg").html("Not found register !").addClass("error");
	    			$(check_regis).addClass("error-line");
	    			is_error = false;
	    		}
	  		},
	  		error : function(error){
			   	alert(error);
			} 
		})
	}
}



