<?php

include("../dbconnect.php");

if(isset($_POST['cmd'])){
    $cmd = $_POST['cmd'];
    $res = array();
    if($cmd == "register"){
        if(isset($_POST['email']) && isset($_POST['firstname']) && isset($_POST['password'])){
            $email = $_POST['email'];
            $name = $_POST['firstname'];
            $password = $_POST['password'];
            $avatar = "img/avatar/profile.png";

            $sql = "SELECT email FROM user WHERE email = :email";
            $query = $dbconnect->prepare($sql);
            $query->bindParam(":email",$email,PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            if($query->rowCount() > 0){
                $res['status'] = "error";
            }else{
                $new_password = password_hash($password, PASSWORD_DEFAULT);
                $sqlinsert = "INSERT INTO user(name,email,password,avatar) VALUES(:name,:email,:password,:avatar)";
                $queryinsert = $dbconnect->prepare($sqlinsert);
                $queryinsert->bindParam(":email",$email,PDO::PARAM_STR);
                $queryinsert->bindParam(":name",$name,PDO::PARAM_STR);
                $queryinsert->bindParam(":password",$new_password,PDO::PARAM_STR);
                $queryinsert->bindParam(":avatar",$avatar,PDO::PARAM_STR);
                $queryinsert->execute();
                $res['status'] = "success";
            }
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

?>