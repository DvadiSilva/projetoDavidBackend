<?php
    require("views/layout/headerSimple.php");
    require("view.navBar.php");
?>

    <div class="col-11">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Utilizadores</h2>
            <?= isset($message)? $message: ""?>
            <a href="/admin/users/create" class="btn-close adminCreateButton" aria-label="create"></a>
        </div>
        <table class="adminTable mb-3">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Username</th>
                <th>Email</th>
                <th>Telemóvel</th>
                <th>Subscritor</th>
                <th>Escritor</th>
                <th>Administrador</th>
                <th>--/--</th>
            </tr>
<?php
    foreach($users as $user){
        echo '
            <tr>
                <td>'.$user["user_id"].'</td>
                <td>'.$user["name"].'</td>
                <td>'.$user["username"].'</td>
                <td>'.$user["email"].'</td>
                <td>'.$user["phone"].'</td>
                <td>'.($user["isSubscriber"]== 0? "Não":"Sim").'</td>
                <td>'.($user["isWriter"]== 0? "Não":"Sim").'</td>
                <td>'.($user["isAdmin"]== 0? "Não":"Sim").'</td>

<td>
    <div class="d-flex align-items-center justify-content-center">
        <button type="button" class="btn p-0 editUserShowModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
            </svg>
        </button>
        <button type="button" class="btn-close deleteUserShowModal"></button>


        <div class="editUserModalWrapper d-none">
            <div class="d-flex justify-content-around editUserModal">
                <div>
                    <h5 class="modal-title">Editar utilizador '.$user["name"].'</h5>
                    <button type="button" id="editUserCloseModal" class="btn-close editUserCloseModal"></button>
                </div>
                <form action="/admin/users" method="post">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Nome" minlength=2 maxlength=60 value="'.$user["name"].'">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Username</label>
                        <input type="text" class="form-control" id="exampleFormControlInput2" name="username" placeholder="Username" minlength=1 maxlength=30 value="'.$user["username"].'">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleFormControlInput3" name="email" placeholder="Email" value="'.$user["email"].'">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput4" class="form-label">Telemóvel</label>
                        <input type="text" class="form-control" id="exampleFormControlInput4" name="phone" placeholder="Telemóvel" minlength=9 maxlength=30 value="'.$user["phone"].'">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1">É subscritor?</label>
                        <select name="isSubscriber" id="exampleFormControlTextarea1" value="'.$user["isSubscriber"].'">
                            <option value="'.$user["isSubscriber"].'" selected disabled hidden>'.($user["isSubscriber"]== 0? "Não":"Sim").'</option>
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select> 
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea2">É escritor?</label>
                        <select name="isWriter" id="exampleFormControlTextarea2" value="'.$user["isWriter"].'">
                            <option value="'.$user["isWriter"].'" selected disabled hidden>'.($user["isWriter"]== 0? "Não":"Sim").'</option>
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select> 
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea3">É administrador?</label>
                        <select name="isAdmin" id="exampleFormControlTextarea3" value="'.$user["isAdmin"].'">
                            <option value="'.$user["isAdmin"].'" selected disabled hidden>'.($user["isAdmin"]== 0? "Não":"Sim").'</option>
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select> 
                    </div>
                    <button type="submit" name="editUser_id" class="btn btn-success editUserButton" value="'.$user["user_id"].'">Guardar</button>
                </form>
            </div>
        </div>

        <div class="deleteUserModalWrapper d-none">
            <div class="d-flex justify-content-around deleteUserModal">
                <div>
                    <h5 class="modal-title">Apagar utilizador '.$user["name"].'?</h5>
                    <button type="button" id="deleteUserCloseModal" class="btn-close deleteUserCloseModal"></button>
                </div>
                <div>
                    Será definitivo
                </div>
                <div>
                    <button type="button" class="btn btn-danger deleteUserButton" data-user-id="'.$user["user_id"].'">Sim</button>
                    <button type="button" class="btn btn-primary deleteUserCloseModal2">Não</button>
                </div>
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
            <a class="page-link" href="/admin/users/<?= empty($page)? "0":$page-1?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="page-item">
            <a 
                class="page-link" 
                href="/admin/users/<?= empty($page)? "0":$page-1?>">
                    <?= empty($page)? "-":$page-1?>
            </a>
        </li>
        <li class="page-item">
            <a 
                class="page-link" 
                href="/admin/users/<?= empty($page)? "0":$page?>">
                    <?= empty($page)? "0":$page?>
            </a>
        </li>
        <li class="page-item">
            <a 
                class="page-link"
                href="/admin/users/<?= empty($page)? "1":$page+1?>">
                    <?= empty($page)? "1":$page+1?>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="/admin/users/<?= empty($page)? "1":$page+1?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>

<?php
    require("views/layout/footer.php");
?>