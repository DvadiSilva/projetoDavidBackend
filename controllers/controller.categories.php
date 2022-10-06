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

    $category= $modelCategories-> getCategory($id);

    if(empty($category)){
        http_response_code(404);
    
        $message= "Not Found";
        $title= "Error";
    
        require("views/view.error.php");
        exit;
    }

    $modelNews= new News();
    $allCategoryNews= $modelNews-> getAllCategoryNews($id);

    $maxPage= round(count($allCategoryNews)/10, 0, PHP_ROUND_HALF_UP) +1;

    if(empty($page)){
        $news= $modelNews-> getTenCategoryNews($id);
    }
    else if(!empty($page) && is_numeric($page) && $page> 0 && $page <=$maxPage){
        $news= $modelNews-> getNextCategoryNews($id, $page);
    }
    else{
        http_response_code(400);
        
        $message= "Invalid URL";
        $title= "Error";

        require("views/view.error.php");
        exit;
    }

    if(empty($news)){
        http_response_code(404);
    
        $message= "Not Found";
        $title= "Error";
    
        require("views/view.error.php");
        exit;
    }

    $title= $category["name"];

    require("views/view.categories.php");
?>