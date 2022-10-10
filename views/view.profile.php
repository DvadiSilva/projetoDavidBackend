<?php
    require("layout/headerSimple.php");
?>
  
  <div class="card flex-row border-dark m-3 profileCard">
        <img src="<?= $_SESSION["user"]["photo"] ?>" class="card-img-top p-3 newsImg" alt="...">
        <div class="card-body overflow-auto">
            <h2 class="card-title"><?= $_SESSION["user"]["name"] ?></h2>
            <div>
                <dl class="d-flex justify-content-between profileDl">
                    <div class="d-flex flex-column align-items-center">
                        <dt>Username</dt>
                        <dd><?= $_SESSION["user"]["username"] ?></dd>
                    </div>
                    <div class="d-flex flex-column align-items-center mx-3">
                        <dt>Email</dt>
                        <dd><?= $_SESSION["user"]["email"] ?></dd>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <dt>Telemóvel</dt>
                        <dd><?= $_SESSION["user"]["phone"] ?></dd>
                    </div>

                </dl>
                <dl class="profileDl">
                    <dt>Biografia</dt>
                    <dd><?= $_SESSION["user"]["biografy"]=== ""? "...sem biografia":$_SESSION["user"]["biografy"] ?></dd>
                </dl>
            </div>
            <div class="d-flex justify-content-end">
                <a href="/profile/edit" class="btn btn-primary">
                    Editar perfil
                </a>
            </div>
        </div>
    </div>

<?php
    require("layout/footer.php");
?>