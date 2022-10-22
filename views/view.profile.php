<?php
    require("layout/headerSimple.php");
    
    echo isset($message)? $message: "";
?>
  
  <div class="card flex-row border-dark m-3 profileCard position-relative align-items-center">
        <img src="<?= $_SESSION["user"]["photo"] ?>" class="card-img-top p-3 profilePhoto" alt="...">
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
            <button class="position-absolute changePassword changePasswordShowModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-incognito" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="m4.736 1.968-.892 3.269-.014.058C2.113 5.568 1 6.006 1 6.5 1 7.328 4.134 8 8 8s7-.672 7-1.5c0-.494-1.113-.932-2.83-1.205a1.032 1.032 0 0 0-.014-.058l-.892-3.27c-.146-.533-.698-.849-1.239-.734C9.411 1.363 8.62 1.5 8 1.5c-.62 0-1.411-.136-2.025-.267-.541-.115-1.093.2-1.239.735Zm.015 3.867a.25.25 0 0 1 .274-.224c.9.092 1.91.143 2.975.143a29.58 29.58 0 0 0 2.975-.143.25.25 0 0 1 .05.498c-.918.093-1.944.145-3.025.145s-2.107-.052-3.025-.145a.25.25 0 0 1-.224-.274ZM3.5 10h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5Zm-1.5.5c0-.175.03-.344.085-.5H2a.5.5 0 0 1 0-1h3.5a1.5 1.5 0 0 1 1.488 1.312 3.5 3.5 0 0 1 2.024 0A1.5 1.5 0 0 1 10.5 9H14a.5.5 0 0 1 0 1h-.085c.055.156.085.325.085.5v1a2.5 2.5 0 0 1-5 0v-.14l-.21-.07a2.5 2.5 0 0 0-1.58 0l-.21.07v.14a2.5 2.5 0 0 1-5 0v-1Zm8.5-.5h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5Z"/>
                </svg>
            </button>
            <div class="changePasswordModalWrapper d-none">
                <div class="d-flex justify-content-around changePasswordModal">
                    <div>
                        <h5 class="modal-title">Alterar Password</h5>
                        <button type="button" id="changePasswordCloseModal" class="btn-close changePasswordCloseModal"></button>
                    </div>
                    <form action="/profile" method="post">
                        <div class="mb-3">
                            <input type="password" class="form-control" name="currentPassword" aria-label="Palavra-passe atual" placeholder="Palavra-passe atual" minlength=8 maxlength=1000 required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="newPassword" aria-label="Palavra-passe nova" placeholder="Palavra-passe nova" minlength=8 maxlength=1000 required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="newRepeatedPassword" aria-label="Repetir palavra-passe nova" placeholder="Repetir palavra-passe nova" minlength=8 maxlength=1000 required>
                        </div>
                        <button type="submit" name="changePassword" class="btn btn-success changePasswordButton">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
    require("layout/footer.php");
?>