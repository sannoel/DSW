<?php include 'include/head.php' ?>
<body>
  <?php
  include 'include/header.php';
  if($loged == false){
    header('Location: login.php');
  }

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
  ?>
  <div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Carrinho</strong></div>
      </div>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-12">
          <div class="site-blocks-table">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="product-thumbnail">Imagem</th>
                  <th class="product-name">Produto</th>
                  <th class="product-price">Preço</th>
                  <th class="product-quantity">Quantidade</th>
                  <th class="product-total">Total</th>
                  <th class="product-remove">Remover</th>
                </tr>
              </thead>
              <tbody>

                <?php 
                $count = 0;
                $teste = str_replace(",",".", $freteValor);
                $total = 0+$teste;
                foreach( $resultado_carrinho as $row ) { 
                  echo '
                  <tr>
                  <td class="product-thumbnail">
                  <img src="images/'.$row[2].'.jpg" alt="'.$row[0].'" class="img-fluid">
                  </td>
                  <td class="product-name">
                  <h2 class="h5 text-black">'.$row[0].'</h2>
                  </td>
                  <td>R$ '.number_format($row[1],2,",",".").'</td>
                  <td>
                  <form method="post" action="App/Controller/updateQtd.php">
                  <div class="input-group mb-3" style="max-width: 120px;">
                  <div class="input-group-prepend">
                  <button class="btnQntd btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                  </div>
                  <input type="number" for="id_quantidade" name="id_quantidade" id="id_quantidade" class="form-control input-number text-center" value="'.$row[4].'" min="1" max="100"> 
                  <div class="input-group-append">
                  <button class="btnQntd btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                  </div>
                  <input style="visibility: hidden; width:2%;height:2%;" type="number" name="idproduto" value="'.$row[3].'"> <br>
                  </div>
                  </form>

                  </td>
                  <td>R$ '.number_format($row[1]*$row[4],2,",",".").'</td>
                  <td><a href="App/Controller/delete.php?produto='.$row[3].'" class="btn btn-primary btn-sm">X</a></td>
                  </tr>
                  ';

                  $count = $row[1]*$row[4];
                  $total = $count + $total;
                } 
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="row mb-5">
            <div class="col-md-6">
              <a href="shop.php" class="btn btn-outline-primary btn-sm btn-block">Continuar Comprando</a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label class="text-black h4" for="cep">Cacular Frete</label>
              <p>Coloque o seu CEP para cacular o frete.</p>
            </div>
            <div class="col-md-8 mb-3 mb-md-0">
              <input required type="text" class="form-control py-3" id="cep" name="cep" placeholder="CEP">
            </div>
            <div class="col-md-4">
              <button type="submit" value="submit" class="btn btn-primary btn-sm">Aplicar</button>
            </div>
            <div class="col-md-12 freteResultado" style="<?php if ($freteValor>0) echo "display: block;" ;?>">
              <p>Valor do frete: <?php echo $freteValor; ?></p>
              <p>Prazo de entrega: <?php echo $fretePrazo; ?> Úteis</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 pl-5">
          <div class="row justify-content-end">
            <div class="col-md-7">
              <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                  <h3 class="text-black h4 text-uppercase">Formas de Pagamento</h3>
                </div>
                <div class="col-md-8 mb-3 mb-md-0">
                  <input class="radio" type="radio" name="method" value="cash" checked="checked" /> <span>Boleto</span> <br>
                  <input class="radio" type="radio" name="method" value="ppal" /> <span>Paypal</span>
                </div>
                <div class="col-md-12 text-right border-bottom mb-5">
                  <h3 class="text-black h4 text-uppercase">Total</h3>
                </div>
              </div>
              <?php if ($freteValor>0) echo '
              <div class="row mb-3">
              <div class="col-md-6">
              <span class="text-black">Frete</span>
              </div>
              <div class="col-md-6 text-right">
              <strong class="text-black">R$ '.$freteValor.'</strong>
              </div>
              </div>'
              ;?>
              <div class="row mb-3">
                <div class="col-md-6">
                  <span class="text-black">Subtotal</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">R$ <?php echo number_format($total,2,",",".");?></strong>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-6">
                  <span class="text-black">Total</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">R$ <?php echo number_format($total,2,",",".");?></strong>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <?php
                  if ($count == 0) {
                    echo '<button class="btn btn-primary btn-lg py-3 btn-block" style="opacity: 0.5; filter: alpha(opacity=50)"> Comprar </button disabled>';
                  }else{
                    echo '<a href="checkout.php"> <button class="btn btn-primary btn-lg py-3 btn-block">Comprar</button></a>';
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'include/footer.php'?>
  
  <script src="js/jquery.mask.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script>

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
    $(".input-number").bind("change", function() {
     $(this).closest("form").submit();
   });
 </script>
 <script>
  $(document).ready(function(){
    $('#cep').mask('00000-000');
  });
</script>
</body>
</html>