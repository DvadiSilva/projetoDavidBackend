<?php
    require("layout/headerSimple.php");
?>

<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">

        <div class="px-5 ms-xl-4">
          <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
          <span class="h1 fw-bold mb-0"></span>
        </div>
        <?= isset($message)? $message: ""?>

        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

          <form style="width: 23rem;" action="/login" method="post">

            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

            <div class="form-outline mb-4">
              <input type="email" id="form2Example18" class="form-control form-control-lg" name="email" required/>
              <label class="form-label" for="form2Example18">Email</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="form2Example28" class="form-control form-control-lg" name="password" minlength=8 maxlength=1000 required/>
              <label class="form-label" for="form2Example28">Password</label>
            </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-secondary" type="submit" name="send">Login</button>
            </div>

            <p>Ainda não tem conta? <a href="/register" class="link-info">Crie uma aqui</a></p>

          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-flex justify-content-center align-items-center">
        <img src="/images/jornalinho.png"
          alt="" style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>

<?php
    require("layout/footer.php");
?>