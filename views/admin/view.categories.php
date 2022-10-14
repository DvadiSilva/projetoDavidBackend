<?php
    require("views/layout/headerSimple.php");
    require("view.navBar.php");
?>

    <div class="col-9">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Noticias</h2>
            <form action="/admin/categories" method="post" class="hide" id="categoriesCreateForm">
                <label class="d-flex flex-row align-items-center">
                    Nome da Categoria
                    <input type="text" minlength=3 maxlength=60 required class="form-control" name="category_name">
                </label>
                <button type="submit" name="send" class="btn btn-secondary" id="categoriesSubmitButton">Criar</button>
            </form>
            <button type="button" class="btn-close adminCreateButton" aria-label="create" id="createCategoryButton"></button>
        </div>
        <table class="adminTable">
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
<?php
    foreach($categories as $category){
        echo '
            <tr>
                <td>'.$category["category_id"].'</td>
                <td>'.$category["name"].'</td>
            </tr>
        ';
    }
?>
        </table>
    </div>
</section>

<?php
    require("views/layout/footer.php");
?>