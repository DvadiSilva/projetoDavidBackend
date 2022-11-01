<?php
    require("views/layout/headerSimple.php");
    require("view.navBar.php");
?>

    <div class="col-11">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Noticias</h2>
            <?= isset($message)? $message: ""?>
            <a href="/admin/news/create" class="btn-close adminCreateButton" aria-label="create"></a>
        </div>
        <table class="adminTable">
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagem</th>
                <th>Categoria</th>
                <th>Data de Publicação</th>
                <th>--/--</th>
            </tr>
<?php
    foreach($news as $newsSolo){
        echo '
            <tr>
                <td>'.$newsSolo["news_id"].'</td>
                <td>'.$newsSolo["title"].'</td>
                <td><img src="'.$newsSolo["image"].'" class="adminNewsImg rounded"></td>
                <td>'.$newsSolo["name"].'</td>
                <td>'.$newsSolo["post_date"].'</td>
<td>
    <div class="d-flex align-items-center justify-content-center">
        <a href="/admin/news/edit/'.$newsSolo["news_id"].'" class="btn p-0 editNewsShowModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
            </svg>
        </a>
        <button type="button" class="btn-close deleteNewsShowModal"></button>
    </div>

    <div class="deleteNewsModalWrapper d-none">
        <div class="d-flex justify-content-around deleteNewsModal p-3">
            <div>
                <h5 class="modal-title">Apagar noticia "'.$newsSolo["title"].'"?</h5>
                <button type="button" id="deleteNewsCloseModal" class="btn-close deleteNewsCloseModal"></button>
            </div>
            <div>
                Será definitivo
            </div>
            <div>
                <button type="button" class="btn btn-danger deleteNewsButton" data-news-id="'.$newsSolo["news_id"].'">Sim</button>
                <button type="button" class="btn btn-primary deleteNewsCloseModal2">Não</button>
            </div>
        </div>
    </div>

</td>
            </tr>
        ';
    }
?>
        </table>
        <nav class="d-flex justify-content-center mt-3">
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