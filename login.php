<?php include 'include/head.php' ?>

<body>
  <?php

  include 'include/header.php';

  if($loged){
    header('Location: shop.php');
  }

  include_once 'DataBase/conexao.php';
  include_once 'App/Controller/ClienteController.php';

  $user = new ClienteController();

  if (isset($_POST['enviar'])) {
    $email = trim($_POST['email']);
    $senha = trim(md5($_POST['senha']));
    if ($user->login($email, $senha)) {
      header('Location: shop.php');
      exit;
    }else{
      echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL= login.php'>
      <script type=\"text/javascript\">
      alert(\"Senha ou email incorretos!\");
      </script>
      ";
    }
  }
  ?>
  <div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Login</strong></div>
      </div>
    </div>
  </div>  

  <div class="site-section">
    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <h2 class="h3 mb-3 text-black" style="text-align: center;">Login</h2>

          <form action="" method="post">

            <div class="col-6 p-3 p-lg-5 border" style="margin: 0 auto;">
              <div class="form-group row">
                <div class="col-md-12 p-3">
                  <label for="email" class="text-black">Email</label>
                  <input type="text" id="email" name="email" class="form-control" placeholder="Digite seu email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" required>
                </div>
                <div class="col-md-12 p-3">
                  <label for="senha" class="text-black">Senha</label>
                  <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <label class="btn btn-primary btn-lg btn-block"> <a href="cadastro.php"> Cadastre-se </a> </label>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <input class="btn btn-primary btn-lg btn-block" type="submit" name="enviar">
                </div>
              </div>
            </div>

          </form>

        </div>

      </div>
    </div>
  </div>
  <?php include 'include/footer.php' ?>
</body>
</html>