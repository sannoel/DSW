<?php
    session_start();
    include_once 'App/Controller/ProdutoController.php';
    include_once 'App/Controller/CarrinhoController.php';
    include_once 'App/Controller/ClienteController.php';
    include_once 'DataBase/conexao.php';

    $conn = new Conexao();
    $conn = $conn->conexao();
    
    $stmt4 = $conn->prepare('
      SELECT * FROM carrinho_has_produto;');
    $stmt4->execute();
    $count = 0;
    $count = $stmt4->rowCount();

    $user = new ClienteController();
    $loged = $user->isLoggedIn();
?>
<div class="site-wrap">
  <header class="site-navbar" role="banner">
    <div class="site-navbar-top">
      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
            <form action="" class="site-block-top-search">
              <span class="icon icon-search2"></span>
              <input type="text" class="form-control border-0" placeholder="Pesquisa">
            </form>
          </div>

          <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
            <div class="site-logo">
              <a href="index.php" class="js-logo-clone">Shincell</a>
            </div>
          </div>

          <div class="col-6 col-md-4 order-3 order-md-3 text-right icones-center">
            <div class="site-top-icons">
              <ul>
                <?php
                if ($loged == true) {
                  echo '
                  <li>
                    <a href="cart.php" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>
                      <span class="count">'.$count.'</span>
                    </a>
                  </li> 
                  <li><a href="App/Controller/logout.php"> Sair </a></li>';
                }else{
                  echo '<li><a href="login.php" class="site-cart"><span class="icon icon-person"></span></a></li>';
                }
                ?>
                <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
              </ul>
            </div> 
          </div>

        </div>
      </div>
    </div> 
    <nav class="site-navigation text-right text-md-center" role="navigation">
      <div class="container">
        <ul class="site-menu js-clone-nav d-none d-md-block">
          <li><a href="index.php">Home</a></li>
          <li><a href="shop.php">Loja</a></li>
          <li><a href="contact.php">Contato</a></li>
        </ul>
      </div>
    </nav>
  </header>