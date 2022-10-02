<?php    
    require("models/model.categories.php");
    require("models/model.news.php");

    $modelCategories= new Categories();
    $categories= $modelCategories-> getAllCategories();

    if(empty($categories)){
        http_response_code(500);
    
        $message= "Internal Server Error";
        $title= "Error";
    
        require("views/view.error.php");
        exit;
    }

    $modelNews= new News();
    $news= $modelNews-> getAllNews();

    if(empty($news)){
        http_response_code(500);
    
        $message= "Internal Server Error";
        $title= "Error";
    
        require("views/view.error.php");
        exit;
    }

    $title= "Home";

    require("views/view.home.php");
?>