<?php
require_once '../DB/Database.php'; // ALTERE SEU DIRETORIO CONFORME SALVO NO SEU LOCAL

class Produto {
    private $nome;
    private $descricao;
    private $preco;
    private $estoque;
    private $db;

    public function __construct($dados) {
        $this->nome = $dados['nome'];
        $this->descricao = $dados['descricao'];
        $this->preco = $dados['preco'];
        $this->estoque = $dados['estoque'];
        $this->db = new Database('produtos');
    }

    public function cadastrarProduto() {
        $values = [
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco' => $this->preco,
            'estoque' => $this->estoque
        ];

        return $this->db->insert($values);
    }

    public static function listarProdutos() {
        $db = new Database('produtos');
        return $db->select();
    }

    public static function buscarPorId($id) {
        $db = new Database('produtos');
        $result = $db->select("id = {$id}");
    
        // Pegando o primeiro resultado como array associativo
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function excluirProduto($id) {
        $db = new Database('produtos');
        return $db->delete("id = {$id}");
    }

    public static function atualizarProduto($id, $dados) {
        $db = new Database('produtos');
        return $db->update($dados, "id = {$id}");
    }
}
?>
