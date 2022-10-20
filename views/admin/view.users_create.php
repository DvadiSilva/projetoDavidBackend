<?php
    require("views/layout/headerSimple.php");
    require("view.navBar.php");
?>

<div class="col-9">
        <h2>Criação de utilizador</h2>
        <?= isset($message)? $message: ""?>
        <form action="/admin/users/create" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nome</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Nome" minlength=3 maxlength=60 required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput2" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleFormControlInput2" name="username" placeholder="Username" minlength=1 maxlength=30 required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput3" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleFormControlInput3" name="email" placeholder="Email" required>
            </div>
            <div class="d-flex justify-content-around">
                <div class="mb-3 text-center">
                    <label for="exampleFormControlInput4" class="form-label">Telemóvel</label>
                    <input type="text" class="form-control" id="exampleFormControlInput4" name="phone" placeholder="Telemóvel" minlength=9 maxlength=30 required>
                </div>
                <div class="mb-3 text-center">
                    <label for="exampleFormControlInput5" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleFormControlInput5" name="password" placeholder="Password" minlength=8 maxlength=1000 required>
                </div>
                <div class="mb-3 text-center">
                    <label for="exampleFormControlInput6" class="form-label">Repetir Password</label>
                    <input type="password" class="form-control" id="exampleFormControlInput6" name="passwordRepeated" placeholder="Repetir password" minlength=8 maxlength=1000 required>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput5" class="form-label">Fotografia</label>
                <input type="file" class="form-control" id="exampleFormControlInput5" accept="image/png, image/jpeg" name="photo">
            </div>
            <div class="d-flex justify-content-around">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1">É subscritor?</label>
                    <select name="isSubscriber" id="exampleFormControlTextarea1" required>
                        <option value="" selected disabled hidden>...</option>
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select> 
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea2">É escritor?</label>
                    <select name="isWriter" id="exampleFormControlTextarea2" required>
                        <option value="" selected disabled hidden>...</option>
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select> 
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea3">É administrador?</label>
                    <select name="isAdmin" id="exampleFormControlTextarea3" required>
                        <option value="" selected disabled hidden>...</option>
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select> 
                </div>
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