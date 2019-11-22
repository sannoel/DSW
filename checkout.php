<?php include 'include/head.php' ?>
<body>
  <?php
  include 'include/header.php';

  $cpf = $_SESSION["user_cpf"];

  $stmt = $conn->prepare('
    SELECT produto.nome, produto.valor, produto.imagem, produto.idproduto, gerou.quantidade FROM produto 

    INNER JOIN
    (SELECT carrinho_has_produto.produto_idproduto, carrinho_has_produto.quantidade FROM carrinho_has_produto
    INNER JOIN produto ON carrinho_has_produto.produto_idproduto = produto.idproduto
    INNER JOIN carrinho ON carrinho_has_produto.carrinho_idcarrinho = carrinho.idcarrinho 
    WHERE carrinho.cliente_cpf = "'.$cpf.'"
    GROUP BY carrinho_has_produto.produto_idproduto) as gerou 

    ON produto.idproduto = gerou.produto_idproduto
    GROUP BY produto.nome;');

  $total = 0;
  $stmt->execute();

  $resultado_carrinho = $stmt->fetchAll();

  $stmt = $conn->prepare('
    SELECT cliente.cep, cliente.endereco, cliente.complemento, cliente.estado, cliente.numero FROM cliente WHERE cliente.cpf = "'.$cpf.'";');

  $stmt->execute();

  $resultado_endereco = $stmt->fetchAll();

  foreach( $resultado_endereco as $row ) {
    $cep         = $row[0];
    $endereco    = $row[1];
    $complemento = $row[2];
    $estado      = $row[3];
    $numero      = $row[4];
  }
  if ($complemento==null){ $complemento = "Sem Complemento"; }

  ?>
  <div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.php">Carrinho</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Compra</strong></div>
      </div>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
      <form action="thankyou.php" method="POST">
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Detalhes da Compra</h2>
            <div class="p-3 p-lg-5 border">

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_cep" class="text-black">CEP</label>
                  <input type="text" class="form-control" id="c_cep" name="c_cep" value="<?php echo $cep; ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label for="c_estado" class="text-black">Estado</label>
                  <input type="text" class="form-control" id="c_estado" name="c_estado" value="<?php echo $estado; ?>" readonly>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_endereco" class="text-black">Endereço</label>
                  <input type="text" class="form-control" id="c_endereco" name="c_endereco" value="<?php echo $endereco; ?>" readonly>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_complemento" class="text-black">Complemento</label>
                  <input type="text" class="form-control" id="c_complemento" name="c_complemento" value="<?php echo $complemento; ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label for="c_numero" class="text-black">Número</label>
                  <input type="text" class="form-control" id="c_numero" name="c_numero" value="<?php echo $numero; ?>" readonly>
                </div>
              </div>

              <div class="form-group">
                <label for="c_ship_different_endereco" class="text-black" data-toggle="collapse" href="#ship_different_endereco" role="button" aria-expanded="false" aria-controls="ship_different_endereco"><input type="checkbox" value="1" id="c_ship_different_endereco"> Enviar para um endereço diferente?</label>
                <div class="collapse" id="ship_different_endereco">
                  <div class="py-2">

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="c_diff_cep" class="text-black">CEP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_diff_cep" name="c_diff_cep">
                      </div>
                      <div class="col-md-6">
                        <label for="c_diff_estado" class="text-black">Estado <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_diff_estado" name="c_diff_estado" readonly>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-12">
                        <label for="c_diff_endereco" class="text-black">Endereço <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_diff_endereco" name="c_diff_endereco" readonly>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="c_diff_complemento" class="text-black">Complemento <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_diff_complemento" name="c_diff_complemento">
                      </div>
                      <div class="col-md-6">
                        <label for="c_diff_numero" class="text-black">Número <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_diff_numero" name="c_diff_numero">
                      </div>
                    </div>

                  </div>

                </div>
              </div>

              <div class="form-group">
                <label for="c_order_notes" class="text-black">Observações</label>
                <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Escreva suas observações de compra aqui..."></textarea>
              </div>

            </div>
          </div>
          <div class="col-md-6">

            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Código do Cupom</h2>
                <div class="p-3 p-lg-5 border">

                  <label for="c_code" class="text-black mb-3">Insira aqui o código do seu cupom</label>
                  <div class="input-group w-75">
                    <input type="text" class="form-control" id="c_code" placeholder="Código do cupom" aria-label="Coupon Code" aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Aplicar</button>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Seu Pedido</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Produto</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                      <?php 
                      $count = 0;
                      $subtotal = 0;
                      foreach( $resultado_carrinho as $row ) { 
                        echo '
                        <tr>
                        <td>'.$row[0].' <strong class="mx-2">x</strong> '.$row[4].'</td>
                        <td>R$ '.number_format($row[1]*$row[4],2,",",".").'</td>
                        </tr>
                        ';

                        $count = $row[1]*$row[4];
                        $subtotal = $count + $subtotal;
                      }
                      $total = $subtotal;
                      ?>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Subtotal</strong></td>
                        <td class="text-black">R$ <span id="subtotal"><?php echo number_format($subtotal,2,",",".");?></span></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Frete</strong></td>
                        <td class="text-black" id="frete">R$ <span id="valordofrete"></span></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Total</strong></td>
                        <td class="text-black font-weight-bold"><strong>R$ <span id="total"><?php echo number_format($total,2,",",".");?></span></strong></td>
                      </tr>
                    </tbody>
                  </table>


                  <div class="form-group" style="display: flex;flex-direction: column;align-items: center;">
                    <label class="text-black"><input name="pagamento" type="radio"> Boleto</label>

                    <label class="text-black"><input name="pagamento" type="radio"> PayPal</label>
                  </div>

                  <div class="form-group">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="validar()">Finalizar</button>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
      </form>
    </div>
  </div>
  <?php include 'include/footer.php' ?>
  <script src="js/jquery.mask.min.js"></script>
  <script>
    function validar() {
      if($("#c_ship_different_endereco").prop( "checked" )){
        if ($('#c_diff_endereco').val().length === 0 || $('#c_diff_estado').val().length === 0){
          alert ("Cep invalido");
          event.preventDefault();
        }
      }
    }
  </script>

  <script>
    $("#c_diff_cep").focusout(function(){
      $.ajax({
        url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
        dataType: 'json',
        success: function(resposta){
          if(!resposta.erro){
            $("#c_diff_endereco").val(resposta.logradouro);
            $("#c_diff_estado").val(resposta.uf);
            $("#c_diff_numero").focus();
            $.ajax({
              type: 'POST',
              url: 'frete.php',
              data: {c_diff_cep: $("#c_diff_cep").val()},
              dataType: 'html',
              success: function(resposta){
                $('#valordofrete').text(resposta);
                var total = ($('#subtotal').text());
                total = total.replace(".","");
                total = total.replace(",",".");
                total = parseFloat(total);
                frete = resposta.replace(",",".");
                total = total + parseFloat(frete);
                total = total.toString()
                total = total.replace(".",",");
                $('#total').text(total);
              },
            });
          }else {
            $("#c_diff_endereco").val("");
            $("#c_diff_estado").val("");
            $('#total').text(($('#subtotal').text()));
            $("#valordofrete").text("0,00");
            alert ("Cep invalido");
          }
        },
      });
    });
    $(document).ready(function(){
      $('#c_diff_cep').mask('00000-000');
    });
  </script>
</body>
</html>