<?php include 'include/head.php' ?>
<body>
  <?php
  include 'include/header.php';

  $urlProduct = isset($_GET['p']) ? $_GET['p'] : 0;
  $stmt = $conn->prepare('select * from produto where idproduto =  "'.$urlProduct.'"');

  $stmt->execute();
  $products = $stmt->fetchAll();
  foreach ($products as $product)
  {
    $id = $product[0];
    $nome = $product[1];
    $valor = number_format($product[3],2,",",".");
    $imagem = $product[4];
    $texto = $product[5];
  }

  ?>
  <div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo $nome; ?></strong></div>
      </div>
    </div>
  </div>  

  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="images/<?php echo $imagem; ?>.jpg" alt="<?php echo $nome; ?>" title="<?php echo $nome; ?>" class="img-fluid">
        </div>
        <div class="col-md-6">
          <h2 class="text-black"><?php echo $nome; ?></h2>
          <p><?php echo $texto; ?></p>
          <p><strong class="text-primary h4">R$ <?php echo $valor; ?></strong></p>
          <div class="mb-5">
            <div class="input-group mb-3" style="max-width: 120px;">
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
              </div>
              <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
              <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
              </div>
            </div>

          </div>
          <p><a href="App/Controller/addCarrinho.php?produto=<?php echo $id; ?>" class="buy-now btn btn-sm btn-primary">Adicionar ao Carrinho</a></p>

        </div>
      </div>
    </div>
  </div>

  <div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 site-section-heading text-center pt-4">
          <h2>Produtos Relacionados</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="nonloop-block-3 owl-carousel">
            <div class="item">
              <div class="block-4 text-center">
                <figure class="block-4-image">
                  <img src="images/1.jpg" alt="Image placeholder" class="img-fluid">
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="produto.php?p=1">Iphone 8</a></h3>
                  <p class="mb-0">Encontrando o celular perfeito</p>
                  <p class="text-primary font-weight-bold">R$ 3.400</p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="block-4 text-center">
                <figure class="block-4-image">
                  <img src="images/cloth_2.jpg" alt="Image placeholder" class="img-fluid">
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="#">Iphone X</a></h3>
                  <p class="mb-0">Encontrando o celular perfeito</p>
                  <p class="text-primary font-weight-bold">R$ 5.000</p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="block-4 text-center">
                <figure class="block-4-image">
                  <img src="images/cloth_3.jpg" alt="Image placeholder" class="img-fluid">
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="#">Xiaomi Mi 9</a></h3>
                  <p class="mb-0">Encontrando o celular perfeito</p>
                  <p class="text-primary font-weight-bold">$ 2.200</p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="block-4 text-center">
                <figure class="block-4-image">
                  <img src="images/1.jpg" alt="Image placeholder" class="img-fluid">
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="produto.php?p=1">Iphone 8</a></h3>
                  <p class="mb-0">Encontrando o celular perfeito</p>
                  <p class="text-primary font-weight-bold">R$ 3.400</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'include/footer.php' ?>
</body>
</html>