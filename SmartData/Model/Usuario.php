<?php

class Usuario
{
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $nome;
    public $usuario;
    public $senha;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function buscarPorUsuario($login)
    {   
        $query = "SELECT id, nome, senha FROM " . $this->table_name . " WHERE usuario = :usuario LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario", $login);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarSenha($usuario, $novaSenha)
    {   // redefinir senha
        $query = "UPDATE " . $this->table_name . " SET senha = :senha WHERE usuario = :usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":senha", $novaSenha);
        $stmt->bindParam(":usuario", $usuario);

        return $stmt->execute();
    }
}