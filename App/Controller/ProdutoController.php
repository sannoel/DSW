<?php
/**
 * Arquivo que retorna todos os produtos disponiveis do db
 */

class ProdutoController {

    public static function allProdutos(){
        $conexao = new Conexao();
        $conexao = $conexao->conexao();
        $stmt = $conexao->prepare("SELECT * FROM produto;");
        $stmt->execute();
        $produtos = $stmt->fetchAll();
        $stmt = null;
        return $produtos;
    }

    public static function teste(){
        $conexao = new Conexao();
        $conexao = $conexao->conexao();
        $stmt = $conexao->prepare("SELECT * FROM produto WHERE valor > 250;");
        $stmt->execute();
        $produtos = $stmt->fetchAll();
        $stmt = null;
        return $produtos;
    }
}

?>