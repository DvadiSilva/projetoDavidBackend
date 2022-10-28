<?php
require("models/model.categories.php");
require("models/model.news.php");

$modelCategories= new Categories();
$categories= $modelCategories-> getAllCategories();

$modelNews= new News();

if(empty($categories)){
    http_response_code(500);

    $message= "Internal Server Error";
    $title= "Error";

    require("views/view.error.php");
    exit;
}

$page= $url_parts[2] ?? "";

if(!empty($page) && !is_numeric($page)){
    http_response_code(400);
    
    $message= "Invalid URL";
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
        $allNews= $modelNews-> getAllSearchNews($_POST["search"]);

        if(empty($allNews)){
            http_response_code(404);
        
            $message= "No results for search";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }
        $_SESSION["lastSearch"]= htmlspecialchars(strip_tags(trim($_POST["search"])));
        $_SESSION["lastSearchMaxPage"]= round(count($allNews)/10, 0, PHP_ROUND_HALF_UP) +1;
        $_SESSION["lastSearchNews"]= $allNews;

        $maxPage= round(count($allNews)/10, 0, PHP_ROUND_HALF_UP) +1;

        if(empty($page)){
            $news= $modelNews-> getTenSearchNews($_POST["search"]);
        }
        
        $title="Search";

        require("views/view.search.php");
        exit;
    }
    else{
        http_response_code(400);
        
        $message= "Please fill the fields";
        $title= "Error";
    
        require("views/view.error.php");
        exit;
    }
}

if($page== 0){
    $news= $modelNews-> getTenSearchNews($_SESSION["lastSearch"]);

    $title="Pesquisa";

    require("views/view.search.php");
}

elseif(!empty($page) && is_numeric($page) && $page> 0 && $page <=$_SESSION["lastSearchMaxPage"]){
    $news= $modelNews-> getNextSearchNews($_SESSION["lastSearch"], $page);

    $title="Pesquisa";

    if(empty($news)){
        http_response_code(404);
    
        $message= "Not Found";
        $title= "Error";
    
        require("views/view.error.php");
        exit;
    }

    require("views/view.search.php");
}
else{
    http_response_code(400);
    
    $message= "Invalid URL";
    $title= "Error";

    require("views/view.error.php");
    exit;
}
