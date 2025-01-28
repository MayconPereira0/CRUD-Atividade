<?php
require '../DB/Database.php'; // ALTERE SEU DIRETORIO CONFORME SALVO NO SEU LOCAL

class Usuario {
    private $id;
    private $nome;
    private $rg;
    private $email;
    private $genero;
    private $data_nascimento;

    public function __construct($dados) {
        $this->nome = $dados['nome'];
        $this->email = $dados['email'];
        $this->telefone = $dados['telefone'];
        $this->rg = $dados['rg'];
        $this->genero = $dados['genero'];
        $this->data_nascimento = $dados['data_nascimento'];
    }

    public function cadastrar() {
        $db = new Database('clientes');
        return $db->insert([
            'nome' => $this->nome,
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
        $db = new Database('usuario');
        $result = $db->select("id_usuario = {$id}");
        return $result ? $result[0] : null;
    }

    public static function excluir($id) {
        $db = new Database('usuario');
        return $db->delete("id_usuario = {$id}");
    }

    public static function atualizar($id, $dados) {
        $db = new Database('usuario');
        return $db->update($dados, "id_usuario = {$id}");
    }

    public static function autenticar($email, $senha) {
        $db = new Database('usuario');
        $usuario = $db->select("email = '{$email}'")->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }

        return null;
    }
}
?>