<?php
    require("layout/headerSimple.php");

    echo isset($message)? $message: "";
?>

  <div class="card flex-row border-dark m-3 profileCard">
        <img src="<?= $_SESSION["user"]["photo"] ?>" class="card-img-top p-3 newsImg" alt="...">
        <div class="card-body">
            <form action="/profile/edit" method="post">
                <h2 class="card-title">
                    <input type="text" name="name" class="profileInput" minlength=2 maxlength=60 value="<?= $_SESSION["user"]["name"] ?>">
                </h2>
                <div>
                    <dl class="d-flex justify-content-between profileDl">
                        <div class="d-flex flex-column align-items-center">
                            <dt>Username</dt>
                            <dd>
                                <input type="text" name="username" minlength=1 maxlength=30 value="<?= $_SESSION["user"]["username"] ?>">
                            </dd>
                        </div>
                        <div class="d-flex flex-column align-items-center mx-3">
                            <dt>Email</dt>
                            <dd>
                                <input type="email" name="email" value="<?= $_SESSION["user"]["email"] ?>">
                            </dd>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <dt>Telemóvel</dt>
                            <dd>
                                <input type="text" name="phone" minlength=9 maxlength=30 value="<?= $_SESSION["user"]["phone"] ?>">
                            </dd>
                        </div>

                    </dl>
                    <dl class="profileDl">
                        <dt>Biografia</dt>
                        <dd>
                            <input type="text" name="biografy" maxlength=140 class="profileInput" value="<?= $_SESSION["user"]["biografy"] ?>">
                        </dd>
                    </dl>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit" name="send">Guardar</button>
                </div>
            </form>
        </div>
    </div>

<?php
    require("layout/footer.php");
?>