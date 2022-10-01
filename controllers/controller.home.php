<?php    
    require("models/model.categories.php");
    require("models/model.news.php");

    $modelCategories= new Categories();
    $categories= $modelCategories-> getAllCategories();

    $title= "Home";

    require("views/view.home.php");
?>