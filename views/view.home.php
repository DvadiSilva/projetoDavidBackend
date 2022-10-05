<?php
    require("layout/header.php");

    foreach($news as $newsSolo){
        echo '
            <div class="card flex-row border-dark m-3 newsSolo">
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
?>
        <nav>
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="/home/<?= empty($id)? "0":$id-1?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a 
                        class="page-link" 
                        href="/home/<?= empty($id)? "0":$id-1?>">
                            <?= empty($id)? "-":$id-1?>
                    </a>
                </li>
                <li class="page-item">
                    <a 
                        class="page-link" 
                        href="/home/<?= empty($id)? "0":$id?>">
                            <?= empty($id)? "0":$id?>
                    </a>
                </li>
                <li class="page-item">
                    <a 
                        class="page-link"
                        href="/home/<?= empty($id)? "1":$id+1?>">
                            <?= empty($id)? "1":$id+1?>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="/home/<?= empty($id)? "1":$id+1?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </body>
</html>