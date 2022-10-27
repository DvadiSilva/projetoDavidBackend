<?php
    require("views/layout/headerSimple.php");
    require("view.navBar.php");
?>

    <div class="col-11">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Categorias</h2>
            <form action="/admin/categories" method="post" class="d-none" id="categoriesCreateForm">
                <label class="d-flex flex-row align-items-center">
                    Nome da Categoria
                    <input type="text" minlength=3 maxlength=60 required class="form-control" name="category_name">
                </label>
                <button type="submit" name="send" class="btn btn-secondary" id="categoriesSubmitButton">Criar</button>
            </form>
            <?= isset($message)? $message: ""?>
            <button type="button" class="btn-close adminCreateButton" aria-label="create" id="createCategoryButton"></button>
        </div>
        <table class="adminTable">
            <tr>
                <th>ID</th>
                <th id="categoryTh">Nome</th>
            </tr>
<?php
    foreach($categories as $category){
        echo '
            <tr>
                <td>'.$category["category_id"].'</td>
                <td class="d-flex justify-content-between align-items-center">
                    '.$category["name"].'
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn p-0 editCategoryShowModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                            </svg>
                        </button>

            <div class="editCategoryModalWrapper d-none">
                <div class="d-flex justify-content-around editCategoryModal">
                    <div>
                        <h5 class="modal-title">Editar categoria '.$category["name"].'</h5>
                        <button type="button" id="editCategoryCloseModal" class="btn-close editCategoryCloseModal"></button>
                    </div>
                    <form action="/admin/categories" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="category_name" aria-label="Categoria" placeholder="Nome da categoria" minlength=3 maxlength=60 value="'.$category["name"].'" required>
                        </div>
                        <button type="submit" name="editCategory_id" class="btn btn-success editCategoryButton" value="'.$category["category_id"].'">Guardar</button>
                    </form>
                </div>
            </div>

                        <div class="deleteCategoryModalWrapper d-none">
                            <div class="d-flex justify-content-around deleteCategoryModal">
                                <div>
                                    <h5 class="modal-title">Apagar categoria '.$category["name"].'?</h5>
                                    <button type="button" id="deleteCategoryCloseModal" class="btn-close deleteCategoryCloseModal"></button>
                                </div>
                                <div>
                                    Será definitivo
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger deleteCategoryButton" data-category-id="'.$category["category_id"].'">Sim</button>
                                    <button type="button" class="btn btn-primary deleteCategoryCloseModal2">Não</button>
                                </div>
                            </div>
                        </div>

                        
                        <button type="button" class="btn-close deleteCategoryShowModal"></button>
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
            <a class="page-link" href="/admin/categories/<?= empty($page)? "0":$page-1?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="page-item">
            <a 
                class="page-link" 
                href="/admin/categories/<?= empty($page)? "0":$page-1?>">
                    <?= empty($page)? "-":$page-1?>
            </a>
        </li>
        <li class="page-item">
            <a 
                class="page-link" 
                href="/admin/categories/<?= empty($page)? "0":$page?>">
                    <?= empty($page)? "0":$page?>
            </a>
        </li>
        <li class="page-item">
            <a 
                class="page-link"
                href="/admin/categories/<?= empty($page)? "1":$page+1?>">
                    <?= empty($page)? "1":$page+1?>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="/admin/categories/<?= empty($page)? "1":$page+1?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>

<?php
    require("views/layout/footer.php");
?>