<?php include 'include/head.php' ?>
<body>
  <?php include 'include/header.php' ?>
  

  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <span class="icon-check_circle display-3 text-success"></span>
          <h2 class="display-3 text-black">Obrigado pela Compra!</h2>
          <a href="boleto.php"><p class="lead mb-5">Boleto para Pagamento</p></a>
          <p> ----N° do comprovante----</p>
          <p id="demo"></p>

          <script>
            document.getElementById("demo").innerHTML =
            Math.floor(Math.random() * 10000000000000);
          </script>
          
        </div>
      </div>
    </div>
  </div>
  <?php include 'include/footer.php' ?>
</body>
</html>