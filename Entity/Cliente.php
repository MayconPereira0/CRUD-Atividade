<?php
require_once '../DB/Database.php'; // ALTERE SEU DIRETORIO CONFORME SALVO NO SEU LOCAL

class Cliente {
    private $id;
    private $nome;
    private $rg;
    private $cpf;
    private $cnpj;
    private $email;
    private $telefone;
    private $genero;
    private $data_nascimento;
    private $endereco_completo;
    private $profissao;

    public function __construct($dados) {
        $this->nome = $dados['nome_completo'];
        $this->email = $dados['email'];
        $this->telefone = $dados['telefone'];
        $this->cpf = $dados['cpf'];
        $this->cnpj = $dados['cnpj'];
        $this->rg = $dados['rg'];
        $this->genero = $dados['genero'];
        $this->data_nascimento = $dados['data_nascimento'];
        $this->endereco_completo = $dados['endereco_completo'];
        $this->profissao = $dados['profissao'];
    }

    public function cadastrar() {
        $db = new Database('clientes');
        return $db->insert([
            'nome_completo' => $this->nome,
            'endereco_completo' => $this->endereco_completo,
            'profissao' => $this->profissao,
            'cpf' => $this->cpf,
            'cnpj' => $this->cnpj,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'rg' => $this->rg,
            'genero' => $this->genero,
            'data_nascimento' => $this->data_nascimento,
        ]);
    }

    public static function listar() {
        $db = new Database('clientes');
        return $db->select();
    }

    public static function buscarPorId($id) {
        $db = new Database('clientes');
        $result = $db->select("id = {$id}");
    
        // Pegando o primeiro resultado como array associativo
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function excluir($id) {
        $db = new Database('clientes');
        return $db->delete("id = {$id}");
    }

    public static function atualizar($id, $dados) {
        $db = new Database('clientes');
        return $db->update($dados, "id = {$id}");
    }

    public static function autenticar($email, $senha) {
        $db = new Database('clientes');
        $Cliente = $db->select("email = '{$email}'")->fetch(PDO::FETCH_ASSOC);

        if ($Cliente && password_verify($senha, $Cliente['senha'])) {
            return $Cliente;
        }

        return null;
    }
}
?>