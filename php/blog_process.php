<?php
session_start();
include("../dbconnect.php");
include("../function/all_function.php");

if(isset($_GET['cmd'])){
    $cmd = $_GET['cmd'];
    if($cmd == "get_list"){
        if($_GET['limit']){
            $limit = $_GET['limit'];
            $data = queryMode("load_blog",$limit);
            echo json_encode($data);
            exit();
        }else{
            $res['status'] = "Not Found Parameter";
            echo json_encode($res);
            exit();
        }
    }else if($cmd == "get_popular"){
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
            $limit = $_GET['limit'];
            $data = queryMode("load_popular",$limit);
            echo json_encode($data);
            exit();
        }else{
            $res['status'] = "Not Found Parameter";
            echo json_encode($res);
            exit();
        }
    }else if($cmd == "load_pages"){
        if(isset($_GET['last_id'])){
            $last_id = $_GET['last_id'];
            $data = queryMode("load_page",$last_id);
            echo json_encode($data);
            exit();
        }else{
            $res['status'] = "Not Found Parameter";
            echo json_encode($res);
            exit();
        }
    }else if($cmd == "delete_blog"){
        if(isset($_GET['id']) && isset($_SESSION['profile'])){
            $id = $_GET['id'];
            $user_id = $_SESSION['profile'][0]['user_id'];
            deleteBlog($user_id,$id);
            $res['status'] = "success";
            echo json_encode($res);
            exit();
        }else{
            $res['status'] = "Not Found Parameter";
            echo json_encode($res);
            exit();
        }
    }else if($cmd == "edit_blog"){
        if(isset($_GET['id']) && isset($_SESSION['profile']) && isset($_GET['user_id'])){
            $obj = array();
            $obj['id'] = $_GET['id'];
            $obj['user_id'] = $_GET['user_id'];
            $data = queryMode("edit_blog",$obj);
            $res['status'] = "success";
            $res['data'] = $data;
            echo json_encode($res);
            exit();
        }else{
            $res['status'] = "Not Found Parameter";
            echo json_encode($res);
            exit();
        }
    }
}else if(isset($_POST['cmd'])){
    $cmd = $_POST['cmd'];
    if($cmd == "create_blog"){
        if(isset($_POST['topic']) && isset($_POST['content']) && isset($_FILES['file']) && $_SESSION['profile'] && isset($_POST['user_id'])){
            $obj = array();
            $obj['topic'] = $_POST['topic'];
            $obj['content'] = $_POST['content'];
            $obj['user_id'] = $_POST['user_id'];
            $obj['start_id'] = $_POST['start_id'];
            $file = $_FILES['file'];
            $obj['path'] = uploadImg($file);     
            insertBlog($obj);
            $data = queryMode("load_data_create",$obj);
            $res['status'] = "success";
            $res['data'] = $data;
            echo json_encode($res);
            exit();
        }else{
            $res['status'] = "Not Found Parameter";
            echo json_encode($res);
            exit();
        }
    }else if($cmd == "update_blog"){
        if(isset($_POST['id']) && isset($_POST['content']) && isset($_POST['topic']) && isset($_SESSION['profile']) && isset($_POST['user_id'])){
            $obj = array();
            $obj['id'] = $_POST['id'];
            $obj['topic'] = $_POST['topic'];
            $obj['content'] = $_POST['content'];
            $obj['user_id'] = $_POST['user_id'];
            if (isset($_FILES['file'])) {
                $file = $_FILES['file'];
                $obj['path'] = uploadImg($file);
            }
            updateBlog($obj);
            $data = queryMode("load_data_update",$obj['id']);
            $res['status'] = "success";
            $res['data'] = $data;
            echo json_encode($res);
            exit();
        }else{
            $res['status'] = "Not Found Parameter";
            echo json_encode($res);
            exit();
        }
    }
}

?>