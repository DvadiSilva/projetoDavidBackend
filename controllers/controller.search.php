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

if(
    isset($_POST["send"])
){
    if(
        mb_strlen($_POST["search"])>= 1   &&
        mb_strlen($_POST["search"])<= 30
    ){
        $modelNews= new News();
        $news= $modelNews-> getSearchNews($_POST["search"]);

        if(empty($news)){
            http_response_code(404);
        
            $message= "No results for search";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }
        
        $title="Search";

        require("views/view.search.php");
    }
    else{
        http_response_code(400);
        
        $message= "Please fill the fields";
        $title= "Error";
    
        require("views/view.error.php");
        exit;
    }
}
