<?php
require_once '../DB/Database.php'; // Ajuste o caminho conforme sua estrutura

class Venda {
    private $cliente_id;
    private $produtos; // Array com ID do produto e quantidade
    private $total;
    private $db;

    public function __construct($dados) {
        $this->cliente_id = $dados['cliente_id'];
        // Certifique-se de que 'produtos' é um array, pode vir de um JSON
        $this->produtos = json_decode($dados['produtos'], true); // Usa json_decode se for uma string JSON
        $this->db = new Database('vendas'); // Passa a tabela 'vendas' como parâmetro
    }

    public function registrar() {
        try {
            // Calcula o total da venda e verifica o estoque
            $this->total = 0;
            foreach ($this->produtos as $produto) {
                // Consulta os dados do produto
                $produtoData = $this->db->execute("SELECT preco, estoque FROM produtos WHERE id = ?", [$produto['id']])->fetch();
                if ($produtoData['estoque'] < $produto['quantidade']) {
                    throw new Exception("Estoque insuficiente para o produto ID {$produto['id']}");
                }
                $this->total += $produtoData['preco'] * $produto['quantidade'];
            }

            // Registra a venda
            $this->db->execute("INSERT INTO vendas (cliente_id, data, total) VALUES (?, NOW(), ?)", [$this->cliente_id, $this->total]);
            $vendaId = $this->db->lastInsertId(); // Obtém o ID da venda inserida

            // Associa os produtos à venda
            foreach ($this->produtos as $produto) {
                // Insere os produtos vendidos
                $produtoData = $this->db->execute("SELECT preco FROM produtos WHERE id = ?", [$produto['id']])->fetch();
                $this->db->execute("INSERT INTO itens_venda (venda_id, produto_id, quantidade, preco) VALUES (?, ?, ?, ?)", [
                    $vendaId,
                    $produto['id'],
                    $produto['quantidade'],
                    $produtoData['preco']
                ]);
            }

            return true; // Venda registrada com sucesso
        } catch (Exception $e) {
            return "Erro: " . $e->getMessage(); // Retorna erro se houver algum problema
        }
    }

    public static function listar() {
        $db = new Database('vendas'); // Passa a tabela 'vendas'
        $result = $db->execute("SELECT v.id, c.nome_completo, v.total, v.data 
                                FROM vendas v 
                                JOIN clientes c ON v.cliente_id = c.id 
                                ORDER BY v.data DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
