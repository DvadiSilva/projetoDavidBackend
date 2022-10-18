<?php
    require("views/layout/headerSimple.php");
    require("view.navBar.php");
?>

    <div class="col-9">
        <h2>Utilizadores</h2>
        <?= isset($message)? $message: ""?>
        <table class="adminTable">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>isSubcriber</th>
                <th>isWritter</th>
                <th>isAdmin</th>
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
                <td>'.$user["isSubscriber"].'</td>
                <td>'.$user["isWriter"].'</td>
                <td>'.$user["isAdmin"].'</td>

<td>
    <div class="d-flex align-items-center">
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
                <form action="/admin/categories" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" aria-label="Utilizador" placeholder="Nome da categoria" minlength=3 maxlength=60 value="'.$user["name"].'" required>
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

<?php
    require("views/layout/footer.php");
?>