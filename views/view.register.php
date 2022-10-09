<?php
    require("layout/headerSimple.php");
?>

<section class="text-center text-lg-start">
  <style>
    .cascading-right {
      margin-right: -50px;
    }

    @media (max-width: 991.98px) {
      .cascading-right {
        margin-right: 0;
      }
    }
  </style>
<?= isset($message)? $message: ""?>
  <div class="container py-4 registerContainer">
    <div class="row g-0 align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
          <div class="card-body p-5 shadow-5 text-center">
            <h2 class="fw-bold mb-5">Registar agora</h2>
            <form action="/register" method="post">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="text" id="form3Example1" class="form-control" name="name" minlength=2 maxlength=60 required/>
                            <label class="form-label" for="form3Example1">Nome</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="text" id="form3Example2" class="form-control" name="username" minlength=1 maxlength=30 required/>
                            <label class="form-label" for="form3Example2">Username</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="email" id="form3Example3" class="form-control" name="email" required/>
                            <label class="form-label" for="form3Example3">Email</label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-outline mb-4">
                            <input type="text" id="form3Example4" class="form-control" name="phone" minlength=9 maxlength=30 required/>
                            <label class="form-label" for="form3Example4">Telemóvel</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline mb-4">
                            <input type="password" id="form3Example5" class="form-control" name="password" minlength=8 maxlength=1000 required/>
                            <label class="form-label" for="form3Example5">Password</label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-outline mb-4">
                            <input type="password" id="form3Example6" class="form-control" name="passwordRepeated" minlength=8 maxlength=1000 required/>
                            <label class="form-label" for="form3Example6">Repita Password</label>
                        </div>
                    </div>
                </div>
                <div class="form-check d-flex justify-content-center mb-4">
                    <input class="form-check-input me-2" type="checkbox" name="isSubscriber" value=1 id="form2Example33" checked />
                    <label class="form-check-label" for="form2Example33">
                        Subscreva a nossa newsletter
                    </label>
                </div>
                <button type="submit" name="send" class="btn btn-primary btn-block mb-4">
                    Registar
                </button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0">
        <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4"
          alt="" />
      </div>
    </div>
  </div>
</section>

<?php
    require("layout/footer.php");
?>