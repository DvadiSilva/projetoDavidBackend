<?php    
    require("models/model.categories.php");
    require("models/model.news.php");

    $modelCategories= new Categories();

    $categories= $modelCategories-> getAllCategories();

    $category= $modelCategories-> getCategory($id);

    $modelNews= new News();
    $news= $modelNews-> getCategoryNews($id);

    $title= $category["name"];

    require("views/view.categories.php");
?>