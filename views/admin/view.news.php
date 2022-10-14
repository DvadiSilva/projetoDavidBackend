<?php
    require("views/layout/headerSimple.php");
    require("view.navBar.php");
?>

    <div class="col-9">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Noticias</h2>
            <a href="/admin/news/create" class="btn-close adminCreateButton" aria-label="create"></a>
        </div>
        <table class="adminTable">
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Data de Publicação</th>
            </tr>
<?php
    foreach($news as $newsSolo){
        echo '
            <tr>
                <td>'.$newsSolo["news_id"].'</td>
                <td>'.$newsSolo["title"].'</td>
                <td>'.$newsSolo["category_id"].'</td>
                <td>'.$newsSolo["post_date"].'</td>
            </tr>
        ';
    }
?>
        </table>
        <nav>
            <ul class="pagination">
                <li class="page-item">
                    <a 
                        class="page-link" 
                        href="/admin/news/<?= empty($page)? "0":$page-1?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a 
                        class="page-link" 
                        href="/admin/news/<?= empty($page)? "0":$page-1?>">
                        <?= empty($page)? "-":$page-1?>
                    </a>
                </li>
                <li class="page-item">
                    <a 
                        class="page-link" 
                        href="/admin/news/<?= empty($page)? "0":$page?>">
                            <?= empty($page)? "0":$page?>
                    </a>
                </li>
                <li class="page-item">
                    <a 
                        class="page-link"
                        href="/admin/news/<?= empty($page)? "1":$page+1?>">
                            <?= empty($page)? "1":$page+1?>
                    </a>
                </li>
                <li class="page-item">
                    <a 
                        class="page-link" 
                        href="/admin/news/<?= empty($page)?"1":$page+1?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>

<?php
    require("views/layout/footer.php");
?>