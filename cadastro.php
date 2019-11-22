<?php include 'include/head.php' ?>

<body>
  <?php
  include 'include/header.php';
  if($loged){
    header('Location: shop.php');
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
          <h2 class="h3 mb-3 text-black" style="text-align: center;">Cadastre-se</h2>

          <form action="App/Controller/emailExists.php" method="post">

            <div class="col-8 p-3 p-lg-5 border" style="margin: 0 auto;">
              <div class="form-group row">
                <div class="col-md-6 p-3">
                  <label class="text-black" for="Nome">Nome</label>
                  <input required="required" type="text" pattern="^[a-zA-Z][a-zA-Z-_\.]{1,20}$" name="Nome" id="Nome" class="form-control" placeholder="Ex: Joao (sem acentos)">
                </div>
                <div class="col-md-6 p-3">
                  <label class="text-black" for="dataNascimento"> Data de Nascimento </label>
                  <input required="required" type="Date" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" min="1970-01-01" max="2000-01-01" name="dataNascimento" id="dataNascimento" class="form-control" placeholder="Digite sua data de nascimento">
                </div>
                <div class="form-group col-md-12" style="display: flex;padding: 0;">
                  <div class="col-md-6 p-3">
                    <label class="text-black" for="cpf"> CPF </label>
                    <input required="required" type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite seu CPF">
                  </div>
                  <div class="col-md-6 p-3">
                    <label for="email" class="text-black">Email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Digite seu email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" required>
                  </div>
                </div>
                <div class="form-group col-md-12" style="display: flex;padding: 0;">
                  <div class="col-md-6">
                    <label for="cep" class="text-black">CEP</label>
                    <input type="text" id="cep" name="cep" class="form-control" placeholder="Digite seu cep" required>
                  </div>
                  <div class="col-md-6">
                    <label for="endereco" class="text-black">Endereço</label>
                    <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Digite seu Endereço" readonly="readonly" required>
                  </div>
                </div>
                <div class="form-group col-md-12" style="display: flex;padding: 0;">
                  <div class="col-md-6">
                    <label for="estado" class="text-black">Estado</label>
                    <input type="text" id="estado" name="estado" class="form-control" placeholder="Digite seu Estado" readonly="readonly" required>
                  </div>
                  <div class="col-md-6">
                    <label for="numero" class="text-black">Número</label>
                    <input type="text" id="numero" name="numero" class="form-control" placeholder="Digite seu número" required>
                  </div>
                </div>
                <div class="form-group col-md-12" style="display: flex;padding: 0;">
                  <div class="col-md-6">
                    <label for="complemento" class="text-black">Complemento</label>
                    <input type="text" id="complemento" name="complemento" class="form-control" placeholder="Digite seu Complemento">
                  </div>
                  <div class="col-md-6">
                    <label for="senha" class="text-black">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <button onclick="validar()" name="cadastrar" class="btn btn-primary btn-lg btn-block">
                    Cadastrar
                  </button>
                </div>
              </div>
            </div>

          </form>

        </div>

      </div>
    </div>
  </div>
  <?php include 'include/footer.php' ?>
  <script src="js/jquery.mask.min.js"></script>
  <script>
    function validar() {
      if ($('#endereco').val().length === 0 || $('#estado').val().length === 0){
        alert ("Cep invalido");
        event.preventDefault();
      }
    }
  </script>
  <script>
    $("#cep").focusout(function(){
      $.ajax({
        url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
        dataType: 'json',
        success: function(resposta){
          if(!resposta.erro){
            $("#endereco").val(resposta.logradouro);
            $("#estado").val(resposta.uf);
            $("#numero").focus();
          }else {
            $("#endereco").val("");
            $("#estado").val("");
            alert ("Cep invalido");
          }
        },
      });
    });
    $(document).ready(function(){
      $('#cpf').mask('000.000.000-00');
      $('#cep').mask('00000-000');
    });
  </script>
</body>
</html>