<?php
    require("layout/header.php");

    echo count($news)==1 ?'<p class="text-center">'.count($news).' resultado encontrado</p>':'<p class="text-center">'.count($news).' resultados encontrados</p>';

    foreach($news as $newsSolo){
        echo '
            <div class="card flex-row border-dark m-3 newsSolo align-items-center bg-light bg-gradient">
                <img src="'.$newsSolo["image"].'" class="card-img-top p-3 newsImg" alt="...">
                <div class="card-body d-flex flex-column justify-content-around">
                    <h3 class="card-title">'.$newsSolo["title"].'</h3>
                    <p class="card-text">'.$newsSolo["summary"].'</p>
                    <div class="row justify-content-around">
                        <div class="col-6 d-flex align-items-center justify-content-center">
                            <a href="/news/'.$newsSolo["news_id"].'" class="btn btn-primary">
                                Mais informação
                            </a>
                        </div>
                        <div class="col-6 d-flex align-items-center justify-content-center">
                            <time>
                                '.date("j M Y H:i", strtotime($newsSolo["post_date"])).'
                            </time>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }

    require("layout/footer.php");
?>