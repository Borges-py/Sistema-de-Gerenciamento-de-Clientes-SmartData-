<?php
class Cliente {
    private $conn;
    private $table_name = "clientes";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar($user_id = null) {
        // filtrar para mostrar somente os clientes de cada usuario
        $query = "SELECT * FROM " . $this->table_name;
        if ($user_id) {
            $query .= " WHERE user_id = :user_id";
        }
        $query .= " ORDER BY nome ASC";

        // bind para segurança
        $stmt = $this->conn->prepare($query);
        if ($user_id) {
            $stmt->bindParam(":user_id", $user_id);
        }
        $stmt->execute();
        return $stmt;
    }

    public function criar($nome, $cpf, $telefone, $email, $endereco, $user_id) {
        // query INSERT para adicionar novo cliente
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nome=:nome, cpf=:cpf, telefone=:telefone, email=:email, endereco=:endereco, user_id=:user_id";

        // bind dos parâmetros para prevenir SQL injection
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":user_id", $user_id);

        // executa e retorna sucesso
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function buscarPorId($id, $user_id = null){
        // previne que um usuário veja/edite clientes de outro.
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        if ($user_id) {
            $query .= " AND user_id = :user_id";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        if ($user_id) {
            $stmt->bindParam(":user_id", $user_id);
        }
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $cpf, $telefone, $email, $endereco, $user_id) {
        $query = "UPDATE " . $this->table_name . " SET nome=:nome, cpf=:cpf, telefone=:telefone, email=:email, endereco=:endereco WHERE id=:id AND user_id=:user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":user_id", $user_id);
        return $stmt->execute();
    }

    public function excluir($id, $user_id) {
    $query = "DELETE FROM " . $this->table_name . " WHERE id = :id AND user_id = :user_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":user_id", $user_id);
    
    return $stmt->execute();
}

    public function cpfExiste($cpf, $user_id, $exclude_id = null) {
        // verifica se o cpf já existe para o usuário, excluindo um id opcional (para updates)
        $query = "SELECT id FROM " . $this->table_name . " WHERE cpf = :cpf AND user_id = :user_id";
        if ($exclude_id) {
            $query .= " AND id != :exclude_id";
        }
        $query .= " LIMIT 1";

        // Executa query preparada
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":user_id", $user_id);
        if ($exclude_id) {
            $stmt->bindParam(":exclude_id", $exclude_id);
        }
        $stmt->execute();
        return $stmt->rowCount() > 0;
        // pega a query para validar se o cpf existe ou não
    }
}