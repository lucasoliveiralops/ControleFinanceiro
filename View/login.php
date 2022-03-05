<?php include 'headerHtml.php' ?>
<main class="login">
  <div class="container">
        <div class="login-page">
          <div class="row">
              <div class="col-lg-5 text-center">
                <img src="View/assets/images/login.gif" class="img-login" >
              </div>
              <div class="col-lg-7 text-center text">
                <h1 class="mb-2">Faça login na sua conta!</h1>
                <form id="loginForm" action="" method="POST">
                  <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Insira seu e-mail:">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password"  id="password" class="form-control" placeholder="Insira sua senha:">
                  </div>
                  <button type="submit" class="btn btn-success">Entrar</button>
                </form>
                <?php if(!empty($msg)){echo $msg;} ?>
              </div>
            </div>
        </div>
  </div>
</main>
<?php include 'footerHtml.php' ?>
