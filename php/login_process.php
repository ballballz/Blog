<?php 
session_start();
include("../dbconnect.php");

if(isset($_POST['cmd'])){
    $cmd = $_POST['cmd'];
    if($cmd == "login"){
        if(isset($_POST['email']) && isset($_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT user_id,email,password,name,avatar FROM user WHERE email = :email";
            $query = $dbconnect->prepare($sql);
            $query->bindParam(":email",$email,PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            if($query->rowCount() > 0){
                $check_pass = $result[0]['password'];
                $user_id = $result[0]['user_id'];
                if(password_verify($password, $check_pass)){
                    $res['status'] = "success";
                    $_SESSION['profile'] = array($result[0]['user_id'],$result[0]['email'],$result[0]['name'],$result[0]['avatar']);
                    echo json_encode($res);
                    exit();
                }else{
                    $res['status'] = "error";
                    echo json_encode($res);
                    exit();
                }
            }else{
                $res['status'] = "error";
                echo json_encode($res);
                exit();
            }
        }else{
            $res['status'] = "error";
            echo json_encode($res);
            exit();
        }
    }else{
        $res['status'] = "error";
        echo json_encode($res);
        exit();
    }
}else{
    $res['status'] = "error";
    echo json_encode($res);
    exit();
}

?>