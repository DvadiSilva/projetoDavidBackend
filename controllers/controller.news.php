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

if(empty($id) || !is_numeric($id)){
    http_response_code(400);
    
    $message= "Invalid URL";
    $title= "Error";

    require("views/view.error.php");
    exit;
}

$modelNews= new News();
$news= $modelNews-> getSoloNews($id);

if(empty($news)){
    http_response_code(404);

    $message= "Not Found";
    $title= "Error";

    require("views/view.error.php");
    exit;
}

$title= $news["title"];

require("views/view.news.php");