<?php 

include("../dbconnect.php");

function uploadImg($file){
    $name = basename($_FILES['file']['name']);
    $file_error = $_FILES['file']['error'];
    $file_list = explode('.', $name);
    $file_type = strtolower(end($file_list));
    $file_new = uniqid() . rand() . "." . $file_type; 
    $type = array('png','jpeg','jpg');
    $upload = '../stocks/' . $file_new;

     if (in_array($file_type,$type)) {
        if ($file_error == 0) {
            if (move_uploaded_file($_FILES['file']['tmp_name'],$upload)) {
                $path_img = $file_new;

                return $path_img;
            }
        }
    }
}

function insertBlog($obj){
    include("../dbconnect.php");
    $cate_id = 1;
    $sqlinsert = "INSERT INTO blog(topic,content,user_id,cate_id,img) VALUES(:topic,:content,:user_id,:cate_id,:img)";
    $queryinsert = $dbconnect->prepare($sqlinsert);
    $queryinsert->bindParam(":topic",$obj['topic'],PDO::PARAM_STR);
    $queryinsert->bindParam(":content",$obj['content'],PDO::PARAM_STR);
    $queryinsert->bindParam(":user_id",$obj['user_id'],PDO::PARAM_INT);
    $queryinsert->bindParam(":cate_id",$cate_id,PDO::PARAM_INT);
    $queryinsert->bindParam(":img",$obj['path'],PDO::PARAM_STR);
    $queryinsert->execute();

}

function deleteBlog($user_id,$id){
    include("../dbconnect.php");
    $sql = "DELETE FROM blog WHERE blog_id = :id and blog.user_id = :user_id";
    $query = $dbconnect->prepare($sql);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    $query->bindParam(":user_id",$user_id,PDO::PARAM_INT);
    $query->execute();

}

function updateBlog($obj){
    include("../dbconnect.php");
    if(isset($obj['path'])){
        $sql = "UPDATE blog SET topic = :topic,content = :content,img = :img WHERE blog_id = :id AND blog.user_id = :user_id";
        $query = $dbconnect->prepare($sql);
        $query->bindParam(":img",$obj['path'],PDO::PARAM_STR);
    }else{
        $sql = "UPDATE blog SET topic = :topic,content = :content WHERE blog_id = :id AND blog.user_id = :user_id";
        $query = $dbconnect->prepare($sql);
    }
    $query->bindParam(":id",$obj['id'],PDO::PARAM_INT);
    $query->bindParam(":topic",$obj['topic'],PDO::PARAM_STR);
    $query->bindParam(":content",$obj['content'],PDO::PARAM_STR);
    $query->bindParam(":user_id",$obj['user_id'],PDO::PARAM_INT);
    $query->execute();
}

function queryMode($mode,$obj) {
    include("../dbconnect.php");
    $sql = "SELECT *
            FROM blog
            INNER JOIN user
            ON blog.user_id = user.user_id
            INNER JOIN category
            ON blog.cate_id = category.cate_id";

    if ($mode == "load_blog") {
        $sql .= " ORDER BY blog_id DESC LIMIT :limit";
        $query = $dbconnect->prepare($sql); 
        $query->bindParam(":limit",$obj,PDO::PARAM_INT);
        $query->execute();
                
    }else if ($mode == "load_popular") {
        $sql .= " ORDER BY blog_id ASC LIMIT :limit";
        $query = $dbconnect->prepare($sql); 
        $query->bindParam(":limit",$obj,PDO::PARAM_INT);
        $query->execute();
        
    }else if ($mode == "load_page") {
        $sql .= " WHERE blog_id < :last_id ORDER BY blog_id DESC Limit 3";
        $query = $dbconnect->prepare($sql); 
        $query->bindParam(":last_id",$obj,PDO::PARAM_INT);
        $query->execute();
                
    } else if ($mode == "load_data_create") {
        $sql .= " WHERE blog.blog_id > :start_id AND blog.user_id = :user_id Limit 1";
        $query = $dbconnect->prepare($sql); 
        $query->bindParam(":start_id",$obj['start_id'],PDO::PARAM_INT);
        $query->bindParam(":user_id",$obj['user_id'],PDO::PARAM_INT);
        $query->execute();

    } else if($mode == "edit_blog") {
        $sql .= " WHERE blog.blog_id = :blog_id AND blog.user_id = :user_id limit 1";
        $query = $dbconnect->prepare($sql); 
        $query->bindParam(":blog_id",$obj['id'],PDO::PARAM_INT);
        $query->bindParam(":user_id",$obj['user_id'],PDO::PARAM_INT);
        $query->execute();
    }else if ($mode == "load_data_update") {
        $sql .= " WHERE blog_id = :blog_id ORDER BY blog_id DESC limit 1";
        $query = $dbconnect->prepare($sql); 
        $query->bindParam(":blog_id",$obj,PDO::PARAM_INT);
        $query->execute();
    }

    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if ($query->rowCount() > 0) {
        $res = array();
        $res["data"] = array();
        $obj = array();

        if(count($result) > 0){
            $res = array();
            $res["data"] = array();
            $obj = array();
            for ($i = 0;$i < count($result); $i++) {
                $obj["blog_id"] = $result[$i]['blog_id'];
                $obj['user_id'] = $result[$i]['user_id'];
                $obj['name'] = $result[$i]['name'];
                $obj["topic"] = $result[$i]['topic'];
                $obj["content"] = $result[$i]['content'];
                $obj["profile"] = $result[$i]['name'];
                $obj["avatar"] = $result[$i]['avatar'];
                $obj["img"] = "stocks/" . $result[$i]['img'];
                $obj["date"] = $result[$i]['create_at'];
                $obj["cate"] = $result[$i]['cate_name'];
    
                $res["data"][] = $obj;
            }
            $res['status'] = "success";
            echo json_encode($res);
            exit();
        }else{
            $res['status'] = "error";
            echo json_encode($res);
            exit();
        }
    } else {
        $res["status"] = "error";
        return $res;
    }
} 

?>