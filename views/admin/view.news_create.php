<?php
    require("views/layout/headerSimple.php");
    require("view.navBar.php");
?>

<div class="col-9">
        <h2>Criação de notícia</h2>
        <?= isset($message)? $message: ""?>
        <form action="/admin/news/create" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Título</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Título da notícia" minlength=3 maxlength=140 required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea2" class="form-label">Sumário</label>
                <textarea class="form-control" id="exampleFormControlTextarea2" name="summary" rows="3" placeholder="Sumário..." required></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea3" class="form-label">Mensagem</label>
                <textarea class="form-control" id="exampleFormControlTextarea3" name="message" rows="3" placeholder="Mensagem..." required></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea4">Categoria:</label>
                <select name="category" id="exampleFormControlTextarea4" required>
                    <option value="" selected disabled hidden>Categoria</option>
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
                <input type="file" class="form-control" id="exampleFormControlInput5" accept="image/png, image/jpeg" name="image" required>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" type="submit" name="send">Criar</button>
            </div>
        </form>
    </div>
</section>

<?php
    require("views/layout/footer.php");
?>