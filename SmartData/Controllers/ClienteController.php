<?php
require_once 'Model/Cliente.php';

class ClienteController
{
    private $db;
    private $clienteModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->clienteModel = new Cliente($db);
    }

    public function listar()
    {
        $user_id = $_SESSION['usuario_id'] ?? null;
        $dados = $this->clienteModel->listar($user_id);
        $clientes = $dados->fetchAll(PDO::FETCH_ASSOC);
        include 'Views/lista_clientes.php';
    }

    public function exibirFormularioCadastro()
    {
        include 'Views/cadastro_clientes.php';
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'] ?? '';
            $cpf  = $_POST['cpf'] ?? '';
            $telefone = $_POST['telefone'] ?? '';
            $email = $_POST['email'] ?? '';
            $endereco = $_POST['endereco'] ?? '';

            // certificando com entradas inválidas
            if (empty($nome) || empty($cpf) || empty($telefone) || empty($email) || empty($endereco)) {
                $_SESSION['erro'] = "Todos os campos são obrigatórios!";
                header("Location: index.php?action=novo");
                exit();
            }

            // verifica se cpf já existe para o usuário atual
            if ($this->clienteModel->cpfExiste($cpf, $_SESSION['usuario_id'])) {
                $_SESSION['erro'] = "Este CPF já está cadastrado para este usuário!";
                header("Location: index.php?action=novo");
                exit();
            }

            // remove caracteres não numéricos do telefone
            $telefoneLimpo = preg_replace('/\D/', '', $telefone);

            // insere novo cliente no banco, associado ao usuário
            $sucesso = $this->clienteModel->criar($nome, $cpf, $telefoneLimpo, $email, $endereco, $_SESSION['usuario_id']);
            
            if ($sucesso) {
                $_SESSION['sucesso'] = "Cliente cadastrado!";
                header("Location: index.php?action=listar");
            } else {
                $_SESSION['erro'] = "Erro ao salvar no banco.";
                header("Location: index.php?action=novo");
            }
            exit();
        }
    }

    public function editar()
    {
        $id = $_GET['id'];
        $user_id = $_SESSION['usuario_id'];
        $cliente = $this->clienteModel->buscarPorId($id, $user_id);
        if (!$cliente) {
            $_SESSION['erro'] = "Cliente não encontrado ou acesso negado.";
            header("Location: index.php?action=listar");
            exit();
        }
        include 'Views/editar_cliente.php';
    }

    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nome = $_POST['nome'] ?? '';
            $cpf = $_POST['cpf'] ?? '';
            $telefone = $_POST['telefone'] ?? '';
            $email = $_POST['email'] ?? '';
            $endereco = $_POST['endereco'] ?? '';

            if (empty($nome) || empty($cpf) || empty($telefone) || empty($email) || empty($endereco)) {
                $_SESSION['erro'] = "Todos os campos são obrigatórios!";
                header("Location: index.php?action=editar&id=$id");
                exit();
            }

            $clienteAtual = $this->clienteModel->buscarPorId($id, $_SESSION['usuario_id']);

            if ($cpf !== $clienteAtual['cpf']) {
                if ($this->clienteModel->cpfExiste($cpf, $_SESSION['usuario_id'], $id)) {
                    $_SESSION['erro'] = "Este CPF já está cadastrado para este usuário!";
                    header("Location: index.php?action=editar&id=$id");
                    exit();
                }
            }

            $telefoneLimpo = preg_replace('/\D/', '', $telefone);

            $sucesso = $this->clienteModel->atualizar(
                $id, 
                $nome, 
                $cpf, 
                $telefoneLimpo, 
                $email, 
                $endereco,
                $_SESSION['usuario_id']
            );

            if ($sucesso) {
                $_SESSION['sucesso'] = "Dados atualizados!";
                header("Location: index.php?action=listar");
            } else {
                $_SESSION['erro'] = "Erro ao atualizar.";
                header("Location: index.php?action=editar&id=$id");
            }
            exit();
        }
    }

    public function excluir()
    {
        $id = $_GET['id'];
        $user_id = $_SESSION['usuario_id'];
        if ($this->clienteModel->excluir($id, $user_id)) {
            $_SESSION['sucesso'] = "Cliente removido com sucesso!";
        } else {
            $_SESSION['erro'] = "Não foi possível excluir o cliente.";
        }
        header("Location: index.php?action=listar");
        exit();
    }
}