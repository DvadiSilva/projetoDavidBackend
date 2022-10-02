<?php
    require("layout/header.php");

    echo '
        <div class="card border-dark m-3">
            <h2 class="card-title">'.$news["title"].'</h2>
            <img src="'.$news["image"].'" class="card-img-top p-3" alt="...">
            <div class="card-body d-flex flex-column justify-content-around">
                <p class="card-text">'.$news["summary"].'</p>
                <p>'.$news["message"].'</p>
            </div>
        </div>
    ';

    require("layout/footer.php");
?>