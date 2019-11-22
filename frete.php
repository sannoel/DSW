<?php

include_once 'DataBase/conexao.php';

function calculaFrete(
   $cep_destino /* cep de destino, apenas numeros */
){
      # ###########################################
      # Código dos Principais Serviços dos Correios
      # 41106 PAC sem contrato
      # 40010 SEDEX sem contrato
      # 40045 SEDEX a Cobrar, sem contrato
      # 40215 SEDEX 10, sem contrato
      # ###########################################

   $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=04696000&sCepDestino=".$cep_destino."&nVlPeso=1&nCdFormato=1&nVlComprimento=30&nVlAltura=30&nVlLargura=30&sCdMaoPropria=n&nVlValorDeclarado=0&sCdAvisoRecebimento=s&nCdServico=04014&nVlDiametro=0&StrRetorno=xml";

   $xml = simplexml_load_file($correios);
   $_arr_ = array();
   if($xml->cServico->Erro == '011' or $xml->cServico->Erro == '0'):
      $_arr_['valor'] = $xml->cServico->Valor;
      $_arr_['prazo'] = $xml->cServico ->PrazoEntrega.' Dias';
         // return $xml->cServico->Valor;
      return $_arr_ ; 
   else:
      return false;
   endif;
}

$conn1 = new Conexao();
$conn1 = $conn1->conexao();

$stmt5 = $conn1->prepare('
   SELECT * FROM carrinho_has_produto;');
$stmt5->execute();
$count = 0;
$count = $stmt5->rowCount();
if(isset($_POST['c_diff_cep']) && !empty($_POST['c_diff_cep'])) {
   $destino = $_POST['c_diff_cep'];
   if($count==0){
     echo "
     <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=shop.php'>
     <script type=\"text/javascript\">
     alert(\"Adicione um produto no carrinho para calcular o Frete!\");
     </script>
     ";
  }else{
      $_resultado = calculaFrete($destino);
      $freteValor = $_resultado['valor'];
      $fretePrazo = $_resultado['prazo'];
      echo $freteValor;
   }
} else{
   $freteValor = 0;
   $fretePrazo = 0;
   echo $freteValor;
}
?>