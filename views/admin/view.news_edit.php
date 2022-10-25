<?php
    require("views/layout/headerSimple.php");
    require("view.navBar.php");
?>

<div class="col-11">
        <h2>Edição de notícia</h2>
        <?= isset($message)? $message: ""?>
        <form action="/admin/news/edit/<?= $news["news_id"]?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Título</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Título da notícia" minlength=3 maxlength=140 value="<?= $news["title"]?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea2" class="form-label">Sumário</label>
                <textarea class="form-control" id="exampleFormControlTextarea2" name="summary" rows="3" placeholder="Sumário..."><?= $news["summary"]?></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea3" class="form-label">Mensagem</label>
                <textarea class="form-control" id="exampleFormControlTextarea3" name="message" rows="3" placeholder="Mensagem..."><?= $news["message"]?></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea4">Categoria:</label>
                <select name="category_id" id="exampleFormControlTextarea4" value="<?= $news["category_id"]?>">
                    <option value="<?= $news["category_id"]?>" selected disabled hidden><?= $news["name"]?></option>
                    <?php
                        foreach($categories as $category){
                            echo '
                                <option value="'.$category["category_id"].'">'.$category["name"].'</option>
                            ';
                        }
                    ?>
                </select> 
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput5" class="form-label">Imagem</label>
                <img src="<?= $news["image"]?>" class="newsEditImg m-3">
                <input type="file" class="form-control" id="exampleFormControlInput5" accept="image/png, image/jpeg" name="image">
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-success" type="submit" name="send">Guardar</button>
            </div>
        </form>
    </div>
</section>

<?php
    require("views/layout/footer.php");
?>