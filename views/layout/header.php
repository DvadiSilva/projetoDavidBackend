<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?> - Jornalinho</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid d-flex justify-content-between">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <?php
                        foreach($categories as $category){
                            echo '
                                <li class="nav-item">
                                    <a
                                        class="nav-link" 
                                        href="/categories/'.$category["category_id"].'">
                                        '.$category["name"].'
                                    </a>
                                </li>
                            ';
                        }
                    ?>
                </ul>
            </div>
        </nav>
        