<?php

include_once('../DB/Database.php'); // Inclui o Model de conexão com o banco

class Funcionario {
    private $conn;

    public function __construct() {
        $db = new Database(); // Instancia a classe Database para ter acesso à conexão
        $this->conn = $db->conn;
    }

    // Função para verificar login
    public function verificarLogin($email, $senha) {
        $sql_code = "SELECT * FROM funcionario WHERE email = :email AND senha = :senha";
        $stmt = $this->conn->prepare($sql_code);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna o resultado da consulta
    }

    // Aqui poderiam ser outras funções que você quiser para o funcionário, como registrar, editar, etc.
}

?>
