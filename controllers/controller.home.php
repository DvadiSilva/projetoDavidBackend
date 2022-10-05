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
    $allNews= $modelNews-> getAllNews();

    $maxPage= round(count($allNews)/10, 0, PHP_ROUND_HALF_UP) +1;

    if(empty($id)){
        $news= $modelNews-> getTenNews();
    }
    else if(!empty($id) && is_numeric($id) && $id> 0 && $id <=$maxPage){
        $news= $modelNews-> getNextNews($id);
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

    $title= "Home";

    require("views/view.home.php");
?>