<?php
    if(empty($_SESSION["user"]["user_id"])){
        http_response_code(401);

        $message= "Unauthorized, please login";
        $title= "Error";

        require("views/view.error.php");
        exit;
    }

    if($_SESSION["user"]["isWriter"]!= 1 && $_SESSION["user"]["isAdmin"]!= 1){
        http_response_code(403);

        $message= "Forbidden";
        $title= "Error";

        require("views/view.error.php");
        exit;
    }

    $title= "Escrever";

    require("models/model.categories.php");
    require("models/model.news.php");

    $modelNews= new News();
    $modelCategories= new Categories();
    $categories= $modelCategories-> getAllCategories();

    if(empty($categories)){
        http_response_code(500);
    
        $message= "Internal Server Error";
        $title= "Error";
    
        require("views/view.error.php");
        exit;
    }

    if(isset($_POST["send"])) {

        if(
            !empty($_POST["title"]) &&
            !empty($_POST["summary"]) &&
            !empty($_POST["message"]) &&
            !empty($_POST["category"]) &&
            mb_strlen($_POST["title"]) >= 3 &&
            mb_strlen($_POST["title"]) <= 140 &&
            isset($_FILES["image"]) &&
            $_FILES["image"]["error"]=== 0 &&
            ($_FILES["image"]["type"]=== "image/png" || 
            $_FILES["image"]["type"]=== "image/jpeg") &&
            $_FILES["image"]["size"] > 0 &&
            $_FILES["image"]["size"] < 2 * 1024 * 1024
        ){
            if($_FILES["image"]["type"]=== "image/png"){
                $imagename= date("YmdHis")."_".mt_rand(10000000, 99999999).".png";
            }
            else{
                $imagename= date("YmdHis")."_".mt_rand(10000000, 99999999).".jpeg";
            }

            move_uploaded_file($_FILES["image"]["tmp_name"], "images/news/".$imagename);

            $_POST["image"]= "/images/news/".$imagename;

            $news_id= $modelNews-> create($_POST);

            if(isset($news_id)){
                header("Location: /news/".$news_id);
            }
            else{
                http_response_code(500);

                $message= "Internal Server Error";
                $title= "Error";
            
                require("views/view.error.php");
                exit;
            }
            
        }
        else{
            $message= "Dados incorretos, confirme o preenchimento dos campos";   
        }
    }

    require("views/view.write.php");
    exit;
?>