<?php
    require("views/layout/headerSimple.php");
    require("view.navBar.php");
?>

    <div class="col-11">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Comentários</h2>
            <?= isset($message)? $message: ""?>
        </div>
        <table class="adminTable mb-3">
            <tr>
                <th>ID</th>
                <th>Utilizador</th>
                <th>Mensagem</th>
                <th>Data</th>
                <th>Notícia</th>
                <th>--</th>
            </tr>
<?php
    foreach($comments as $comment){
        echo '
            <tr>
                <td>'.$comment["comment_id"].'</td>
                <td>'.$comment["username"].'</td>
                <td>'.$comment["message"].'</td>
                <td>'.$comment["post_date"].'</td>
                <td>'.$comment["title"].'</td>
                <td>
                    <button type="button" class="btn-close deleteCommentShowModal"></button>
                    <div class="deleteCommentModalWrapper d-none">
                        <div class="d-flex justify-content-around deleteCommentModal p-3">
                            <div>
                                <h5 class="modal-title">Apagar Comentário "'.$comment["message"].'"?</h5>
                                <button type="button" id="deleteCommentCloseModal" class="btn-close deleteCommentCloseModal"></button>
                            </div>
                            <div>
                                Será definitivo
                            </div>
                            <div>
                                <button type="button" class="btn btn-danger deleteCommentButton" data-comment-id="'.$comment["comment_id"].'">Sim</button>
                                <button type="button" class="btn btn-primary deleteCommentCloseModal2">Não</button>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        ';
    }
?>
        </table>
    </div>
</section>
<nav class="d-flex justify-content-center">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="/admin/comments/<?= empty($page)? "0":$page-1?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="page-item">
            <a 
                class="page-link" 
                href="/admin/comments/<?= empty($page)? "0":$page-1?>">
                    <?= empty($page)? "-":$page-1?>
            </a>
        </li>
        <li class="page-item">
            <a 
                class="page-link" 
                href="/admin/comments/<?= empty($page)? "0":$page?>">
                    <?= empty($page)? "0":$page?>
            </a>
        </li>
        <li class="page-item">
            <a 
                class="page-link"
                href="/admin/comments/<?= empty($page)? "1":$page+1?>">
                    <?= empty($page)? "1":$page+1?>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="/admin/comments/<?= empty($page)? "1":$page+1?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
<?php
    require("views/layout/footer.php");
?>