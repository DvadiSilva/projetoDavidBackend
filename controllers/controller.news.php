<?php
require("models/model.categories.php");
require("models/model.news.php");
require("models/model.comments.php");

$modelCategories= new Categories();
$categories= $modelCategories-> getAllCategories();

if(empty($categories)){
    http_response_code(500);

    $message= "Internal Server Error";
    $title= "Error";

    require("views/view.error.php");
    exit;
}

if(empty($id) || !is_numeric($id)){
    http_response_code(400);
    
    $message= "Invalid URL";
    $title= "Error";

    require("views/view.error.php");
    exit;
}


$modelNews= new News();
$news= $modelNews-> getSoloNews($id);

$modelComments= new Comments();
$comments= $modelComments-> getNewsComments($id);

if(empty($news)){
    http_response_code(404);
    
    $message= "Not Found";
    $title= "Error";
    
    require("views/view.error.php");
    exit;
}

if(isset($_POST["comment"])){
    if(empty($_SESSION["user"]["user_id"])){
        http_response_code(401);

        $message= "Unauthorized, please login";
        $title= "Error";

        require("views/view.error.php");
        exit;
    }

    if(
        !empty($_POST["comment"])   &&
        mb_strlen($_POST["comment"])>= 1 &&
        mb_strlen($_POST["comment"])<= 140
    ){
        $_POST["news_id"]= $id;

        $comment_id= $modelComments-> create($_POST);

        if(isset($comment_id)){
            $message= "Comentário inserido com sucesso";
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
        $message= "Comentário deve conter entre 1 e 140 carateres";
    }
}


$title= $news["title"];

require("views/view.news.php");