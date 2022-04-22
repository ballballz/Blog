var last_id = -1;
var start_id = -1;
var user_id;
if (PROFILE != null || undefined){
	user_id = PROFILE[0]['user_id'];
}
$(document).ready(function(){
	$(".btn-c").click(function(){
		if (PROFILE == null || PROFILE == undefined) {
			Swal.fire('Please Login!')
		} else {
			appendCreate();
		}
	});

	$(".loadmore").click(function(){
		loadPage();
	})
	
	getPopular();
 	getBlog();
});

function menuToggle(id){

	$("#menu_"+id).toggle();
	// $(".list-menu ul").removeClass("show");
	// $("#menu_"+id).addClass("show");
}

function createBlog(){

	var check_blog = $("#form-blog .group-blog .blog-c");
	var is_error = false;

	$(check_blog).removeClass("error-line");

	for (var i=0;i<check_blog.length;i++) {
		var _val = $(check_blog[i]).val();
		// var _attr = $(check_blog[i]).attr("data-c");
		if (_val == "") {
			$(check_blog[i]).addClass("error-line");
			is_error = true;
		}
	}

	var fd = new FormData();
    var files = $("#file-create")[0].files;
	if(files[0].type == "") {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Please select a file!',
		})
		$('.img-cre').css('display', "none");
		$('.img-cre').attr('src', "");
		return
	}
    if($("#file-create")[0].files.length > 0){
		fd.append('file',files[0]);
		fd.append('topic',$("#topic-c").val());
		fd.append('content',$("#content-c").val());
		fd.append('start_id',start_id);
		fd.append('cmd',"create_blog");
       	if (!is_error) {
       		// $("#btn-create").attr("disabled",true);
       		$.ajax({
	          url: 'php/blog_process.php',
	          type: 'post',
	          data: fd,
			  caches: false,
	          contentType: false,
	          processData: false,
	          dataType : "json",
	          beforeSend : function(){
	          	$("#loading").removeClass('hidden');
	          },
	          success: function(data){
	            if (data.status == "success") {
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'Create Blog Success',
						showConfirmButton: false,
						timer: 1500
					})
	            	var new_data = data.data;
	            	appendBlog(new_data,"prepend");
	            	$(".modal-blog").removeClass("show");
					$(".modal-c").remove();
					start_id = new_data[0].blog_id;
					console.log(start_id);     	
				}
	          },
	          complete : function(){
	          	$('#loading').addClass('hidden');
	          },
	          error : function(error){
	          	alert(error);
	          }
	       	});
       		is_error = false;
       	}
    }else{
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Please select a file!',
		})
		// alert("Please select a file.");
    }
}

function editBlog(id){

	var check_edit = {};
	check_edit['cmd'] = "edit_blog";
	check_edit['id'] = id;

	$.ajax({
		url : "php/blog_process.php",
		method : "GET",
		data : check_edit,
		dataType : "json",
		success : function(data){
			if (data.status == "success") {
				var data_edit = data.data[0];
				$(".modal-h").html("");
				console.log(data_edit);
				appendEdit(data_edit);
			}
		},
		error : function(error){
			alert(error);
		}
	})
}

function appendCreate(){

	$(".modal-blog").addClass("show");

	txtHTML = "";
	txtHTML += '<div class="modal-c">'
	txtHTML +=		'<span>บันทึกโพสต์</span>'
	txtHTML +=		'<div class="control-close">'
	txtHTML +=			'<div class="close-c">&times;</div>'
	txtHTML +=		'</div>'
	txtHTML +=		'<div class="text-create" id="form-blog">'
	txtHTML +=			'<div class="group-blog">'
	txtHTML +=				'<input type="text" id="topic-c" class="blog-c" data-c="title_c" placeholder="Title">'
	txtHTML +=			'</div>'
	txtHTML +=			'<div class="group-blog">'
	txtHTML +=				'<textarea rows="6" id="content-c" class="blog-c" data-c="content_c" placeholder="Tell your story..."></textarea>'
	txtHTML +=			'</div>'
	txtHTML += 			'<div class="cre-img">'
	txtHTML +=				'<label for="file-create" class="create-i">'
	txtHTML +=				'<input type="file" id="file-create">'
	txtHTML +=					'<div class="detail-aimg">'
	txtHTML +=						'<div class="img-bg"><img src="img/add.png"></div>'
	txtHTML +=						'<p>เพิ่มรูปภาพ/วิดีโอ</p>'
	txtHTML +=						'<span></span>'
	txtHTML +=						'<img class="img-cre" src="">'
	txtHTML +=					'</div>'
	txtHTML +=				'<label>'
	txtHTML += 			'</div>'
	txtHTML +=			'<div class="btn-create">'
	txtHTML +=				'<input id="btn-create" type="submit" value="บันทึก">'
	txtHTML +=			'</div>'
	txtHTML +=		'</div>'
	txtHTML += '</div>'

	$(".modal-create").append(txtHTML);

	$(".close-c").unbind("click")
	$(".close-c").click(function(){
		$(".modal-blog").removeClass("show");
		$(".modal-c").remove();
	})

	$("#file-create").unbind("change")
	$("#file-create").change(function(){
		readURL(this,"create");
	})

	$("#btn-create").unbind("click")
	$("#btn-create").click(function(){
		createBlog();

	});
}

function readURL(input,mode) {
	if(input.files && input.files[0] && input.files[0].name.match(/\.(jpg|jpeg|png|gif)$/) ) {
		if(input.files[0].size>1048576) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'File size is larger than 1MB!',
			})
			// alert('File size is larger than 1MB!');
		}else{
			var reader = new FileReader();
			if(mode == "create"){
				reader.onload = imageIsCreate;
			}else if(mode == "edit"){
				reader.onload = imageIsEdit;
			}
			reader.readAsDataURL(input.files[0]);
		}
	}else{
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'This is not an image file!',
		})
		$('.img-cre').css('display', "none");
		$('.img-cre').attr('src', "");
		// alert('This is not an image file!');
	}
}

function imageIsCreate(e) {
	result = e.target.result;
	$('.img-cre').css('display', "block");
	$('.img-cre').attr('src', result);
	
};

function imageIsEdit(e) {
	result = e.target.result;
	$('.img-edit').attr('src', result);
	
};

function appendEdit(data_edit){

	$("#menu_"+data_edit.blog_id).hide();
	$(".modal").addClass("show");

	txtHTML = "";
	txtHTML += '<div class="modal-h">'
	txtHTML += 		'<span>แก้ไขโพสต์</span>'
	txtHTML += 		'<div class="control-close">'
	txtHTML +=  		'<div class="close">&times;</div>'
	txtHTML +=		'</div>'
	txtHTML +=		'<div class="modal-profile">'
	txtHTML +=			'<div class="profile-me">'
	txtHTML +=				'<img src="'
	txtHTML +=				data_edit.avatar
	txtHTML +=				'">'
	txtHTML +=			'</div>'
	txtHTML +=			'<div class="profile-public">'
	txtHTML +=				'<span>'
	txtHTML +=				data_edit.name
	txtHTML +=				'</span>'
	txtHTML +=				'<a class="select-target"><img src="img/lock.png">เฉพาะฉัน </a>'
	txtHTML +=			'</div>'
	txtHTML +=		'</div>'
	txtHTML +=		'<div class="text-edit">'
	txtHTML +=			'<div>'
	txtHTML +=				'<input id="topic_up" class="val" type="text" placeholder="Title" value="'+data_edit.topic+'">'
	txtHTML +=				'<textarea class="val" data-update="content" id="content_up" rows="6" cols="100%" placeholder="คุณคิดอะไรอยู่ '
	txtHTML +=				data_edit.name
	txtHTML +=				'">'
	txtHTML +=				data_edit.content
	txtHTML +=				'</textarea>'
	txtHTML +=			'</div>'
	txtHTML += 			'<div class="cre-img">'
	txtHTML +=				'<label for="file-edit" class="create-i">'
	txtHTML +=				'<input type="file" id="file-edit">'
	txtHTML +=					'<div class="detail-aimg">'
	txtHTML +=						'<div class="img-bg"><img src="img/add.png"></div>'
	txtHTML +=						'<p>เพิ่มรูปภาพ/วิดีโอ</p>'
	txtHTML +=						'<span></span>'
	txtHTML +=						'<img class="img-edit" src="'
	txtHTML +=						data_edit.img
	txtHTML +=						'">'
	txtHTML +=					'</div>'
	txtHTML +=				'<label>'
	txtHTML += 			'</div>'
	txtHTML +=		'</div>'
	txtHTML +=		'<div class="btn-edit">'
	txtHTML +=			'<input id="btn-update" onclick="updateBlog('+data_edit.blog_id+')" type="submit" value="บันทึก"> '
	txtHTML +=		'</div>'
	txtHTML +=	'</div>'

	$(".modal-edit").append(txtHTML);

	$(".close").click(function(){
		$(".modal").removeClass("show");
		$(".modal-h").remove();
	})

	$("#file-edit").change(function(){
		readURL(this,"edit");
	})
}

function updateBlog(id){
	// var check_all = {};
	var data = $(".text-edit .val");
	data.removeClass("error-line");

	is_error = false;

	for (var i=0;i<data.length;i++) {
		var _val = $(data[i]).val();
		// var _attr = $(data[i]).attr("data-update");
		if (_val == "") {
			$(data[i]).addClass("error-line");
			is_error = true;
		}
		// check_all[_attr] = _val;
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Please input data',
		})
	}

	var fd = new FormData();
	var files = $("#file-edit")[0].files;
	if (files.length > 0 ) {
		fd.append('file',files[0]);
	}
	
    fd.append('content',$("#content_up").val());
    fd.append('topic',$("#topic_up").val());
    fd.append('id',id);
    fd.append('cmd',"update_blog");

    if (!is_error) {
    	// $("#btn-update").attr("disabled",true);
    	$.ajax({
          	url: 'php/blog_process.php',
          	type: 'post',
          	data: fd,
			caches:false,
          	contentType: false,
          	processData: false,
          	dataType : "json",
          	beforeSend : function(){
	          	$("#loading").removeClass('hidden');
	        },
          	success: function(data){
             	if (data.status == "success") {
             		var data = data.data[0];
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'Update Blog Success',
						showConfirmButton: false,
						timer: 1500
					})
					$("#card_"+ data.blog_id +" .card-box .content").html(data.content);
					$("#card_"+ data.blog_id +" .card-box .topic").html(data.topic);
					$("#img_" + data.blog_id).attr("src",data.img);
					$(".modal").removeClass("show");
					$(".modal-h").html("");
				}
          	},
          	complete : function(){
	          	$("#loading").addClass('hidden');
	        },
	        error : function(error){
	        	alert(error);
	        }
       	});
   		is_error = false;
    }
}

function deleteBlog(id){

	var check_delete = {};
	check_delete['cmd'] = "delete_blog";
	check_delete['id'] = id;

	$.ajax({
		url : "php/blog_process.php",
		method : "GET",
		data : check_delete,
		dataType : "json",
		beforeSend : function(){
	        $("#loading").removeClass('hidden');
	    },
		success : function(data){
			if (data.status == "success") {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Delete Blog Success',
					showConfirmButton: false,
					timer: 1500
				  })
				$("#card_" + id).remove();
				// $("#card_popular_" + id).remove();
			}
		},
		complete : function(){
	          	$("#loading").addClass('hidden');
	    },
		error : function(error){
			alert(error);
		}
	})
}

function loadPage(){
	if(last_id == 1){
		return
	}

	$.ajax({
		url: "php/blog_process.php",
		method:'GET',
		data:{
			"cmd":"load_pages",
			"last_id" : last_id
			},
		dataType: 'json',
		success: function(data) {
			if (data.status == "success") {
				var data_blog = data.data;
				appendBlog(data_blog,"append");
			}
		},
		error : function(error){
			alert(error);
		} 
	});
}

function getPopular(){
	$.ajax({
	    url: "php/blog_process.php",
	    method:'GET',
	    data:{
	    	"cmd":"get_popular",
	    	"limit" : 6
			},
	    dataType: 'json',
	    success: function(data) {
	    	if (data.status == "success") {    		
	    		var data_popular = data.data;
	    		appendPopular(data_popular);
	    	}
	    },
	    error : function(error){
			alert(error);
		}
	});
}

function getBlog(){
	$.ajax({
	    url: "php/blog_process.php",
	    method:'GET',
	    data:{
	    	"cmd":"get_list",
	    	"limit" : 3
	    	},
	    dataType: 'json',
	    success: function(data) {
	    	if (data.status == "success") {    		
	    		var data_blog = data.data; 		
	    		appendBlog(data_blog,"append");
	    		start_id = data_blog[0].blog_id;
	    		console.log(start_id);
	    	}
	    },
	    error : function(error){
			alert(error);
		} 
	});
}

function appendPopular(data_popular){
	for (var i=0;i<data_popular.length;i++){
		var d = new Date(data_popular[i].date);
		var new_date = d.toDateString();
		var txtHTML = "";

		txtHTML += '<div class="card-popular" id="card_popular_'+data_popular[i].blog_id+'">'
		txtHTML += 		'<div class="profile">'
		txtHTML += 			'<img src = "'
		txtHTML += 			data_popular[i].avatar;
		txtHTML += 			'">'	
		txtHTML += 			data_popular[i].profile;
		txtHTML += 		'</div>'
		txtHTML += 		'<div class="topic">'
		txtHTML += 			data_popular[i].topic;
		txtHTML += 		'</div>'
		txtHTML += 		'<div class="date">'
		txtHTML += 			new_date;
		txtHTML += 		'</div>'
		txtHTML += '</div>'

		$(".box-popular").append(txtHTML);
	}
}

function appendBlog(data_blog,mode){

	for (var i=0;i<data_blog.length;i++){
		var d = new Date(data_blog[i].date);
		var new_date = d.toDateString();
		var txtHTML = "";
		txtHTML += '<div class="card" id="card_'+data_blog[i].blog_id+'" data-id='+data_blog[i].blog_id+'>'
		txtHTML += 		'<div class="card-box">'
		txtHTML += 			'<div class="profile">'
		txtHTML += 				'<img src = "'
		txtHTML += 				data_blog[i].avatar;
		txtHTML += 				'">'	
		txtHTML += 				data_blog[i].profile;
		txtHTML += 			'</div>'
		txtHTML += 			'<div class="topic">'
		txtHTML += 				data_blog[i].topic;
		txtHTML += 			'</div>'
		txtHTML += 			'<div class="content">'
		txtHTML += 			data_blog[i].content;
		txtHTML += 			'</div>'
		txtHTML += 			'<div class="date">'
		txtHTML += 				new_date;
		txtHTML += 				'<a class="cate-a" href="#">'
		txtHTML += 					data_blog[i].cate;
		txtHTML += 				'</a>'
		txtHTML +=				'<div class="list"><a onclick="menuToggle('+data_blog[i].blog_id+')">...</a></div>'

		if (user_id == data_blog[i].user_id) { 
		txtHTML +=				'<div class="list-menu">'
		txtHTML +=					'<ul id="menu_'+data_blog[i].blog_id+'">'
		txtHTML +=						'<li><a onclick="editBlog('+data_blog[i].blog_id+')">Edit</a></li>'
		txtHTML +=						'<li><a onclick="deleteBlog('+data_blog[i].blog_id+')">Delete</a></li>'
		txtHTML +=					'</ul>'
		txtHTML +=				'</div>'
		} else {
		txtHTML +=				'<div class="list-menu">'
		txtHTML +=					'<ul id="menu_'+data_blog[i].blog_id+'">'
		txtHTML +=						'<li><a>Report</a></li>'
		txtHTML +=					'</ul>'
		txtHTML +=				'</div>'
		}

		txtHTML += 			'</div>'
		txtHTML += 		'</div>'
		txtHTML += 		'<div class="content-img">'
		txtHTML += 			'<img id="img_'+data_blog[i].blog_id+'" src = "'
		txtHTML += 			data_blog[i].img;
		txtHTML += 			'">'
		txtHTML += 		'</div>'
		txtHTML += '<div>'

		if (mode == "append") {
			$(".control-card").append(txtHTML);
			last_id = data_blog[i].blog_id;
		} else {
			$(".control-card").prepend(txtHTML);
		}
	}
}
