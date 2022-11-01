<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?> - Jornalinho</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="/js/script.js"></script>
        <link rel="stylesheet" href="/css/base.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="btn btn-dark" href="/">Home</a></li>
                </ul>
<?php
    if(isset($_SESSION["user"]) && $_SESSION["user"]["isAdmin"]== 1){
        echo '<a class="btn btn-dark text-center" href="/admin">Painel de Controlo</a>';
    }
    if(isset($_SESSION["user"]) && $_SESSION["user"]["isWriter"]== 1){
        echo '<a class="btn btn-dark text-center" href="/write">Escrever</a>';
    }
    if($controller=== "profile" || $controller=== "admin"){
        echo '<a class="btn btn-dark" href="/logout">Logout</a>';
    }
?>
            </div>
        </nav>