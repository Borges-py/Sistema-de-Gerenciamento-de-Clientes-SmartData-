<?php
class DataBase{
    // configurações de conexão
    private $host = "localhost";
    private $db_name = "gerenciamento_clientes";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // define charset UTF-8 para suporte a caracteres especiais
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            // em caso de erro, exibe mensagem (apenas para debug)
            echo "Erro de conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>