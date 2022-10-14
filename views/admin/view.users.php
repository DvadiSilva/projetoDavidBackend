<?php
    require("views/layout/headerSimple.php");
    require("view.navBar.php");
?>

    <div class="col-9">
        <h2>Utilizadores</h2>
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