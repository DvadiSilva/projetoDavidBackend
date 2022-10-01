<?php    
    require("models/model.categories.php");
    require("models/model.news.php");

    $modelCategories= new Categories();
    $categories= $modelCategories-> getAllCategories();

    $modelNews= new News();
    $news= $modelNews-> getAllNews();

    $title= "Home";

    require("views/view.home.php");
?>