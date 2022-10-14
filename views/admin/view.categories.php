<?php
    require("views/layout/headerSimple.php");
    require("view.navBar.php");
?>

    <div class="col-9">
        <h2>Noticias</h2>
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