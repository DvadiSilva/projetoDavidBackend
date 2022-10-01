<?php    
    require("models/model.categories.php");
    require("models/model.news.php");

    $modelCategories= new Categories();

    $categories= $modelCategories-> getAllCategories();
    $category= $modelCategories-> getCategory($id);

    $title= $category["name"];

    require("views/view.categories.php");
?>