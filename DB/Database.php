<?php

class Database{
    public $conn;
    public string $local="localhost";
    public string $db="gestao_pecas";
    public string $user = "root";
    public string $password = "";
    public $table;


   public function __construct($table = null){
        $this->table = $table;
        $result = $this->conecta();
    }

    public function conecta(){
        try {
            $this->conn = new PDO("mysql:host=".$this->local.";dbname=$this->db",$this->user,$this->password); 
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            // echo "Conectado com Sucesso!!";
        } catch (PDOException $err) {
            //retirar msg em produção
            die("ERRO DE CONEXAO: " . $err->getMessage());
        }
    }
}

?>