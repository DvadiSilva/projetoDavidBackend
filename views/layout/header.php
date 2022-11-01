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
            <div class="container-fluid d-flex justify-content-between">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="/"><img src="/images/jornalinho.png" alt="home" class="commentImg border border-dark"></a></li>
<?php
    foreach($categories as $category){
        echo '
            <li class="nav-item">
                <a
                    class="nav-link" 
                    href="/categories/'.$category["category_id"].'/0">
                    '.$category["name"].'
                </a>
            </li>
        ';
    }
?>
                </ul>
<?php
    if(isset($_SESSION["user"]) && $_SESSION["user"]["isAdmin"]== 1){
        echo '<a class="btn btn-dark text-center" href="/admin">Painel de Controlo</a>';
    }
    if(isset($_SESSION["user"]) && $_SESSION["user"]["isWriter"]== 1){
        echo '<a class="btn btn-dark text-center mx-3" href="/write">Escrever</a>';
    }
?>
                <form class="d-flex align-items-center" action="/search" method="post">
                    <input type="text" name="search" aria-label="search" placeholder="Pesquisar" minlength="1" maxlength="30" required>
                    <button type="submit" class="btn btn-primary" name="send">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </form>
            </div>
<?php
    if(!isset($_SESSION["user"])){
        echo '<a class="btn btn-dark mx-3" href="/login">Login</a>';
    }
    else{
        echo '
            <div class="d-flex align-items-center mx-3">
                <a class="nav-link name" href="/profile">'.$_SESSION["user"]["username"].'</a>
                <a class="nav-link mx-3" href="/profile"><img src="'.$_SESSION["user"]["photo"].'" class="commentImg border border-dark" id="userPhoto" data-username="'.$_SESSION["user"]["username"].'"></a>
                <a class="btn btn-dark" href="/logout">Logout</a>
            </div>
        ';
    }
?>
        </nav>
        