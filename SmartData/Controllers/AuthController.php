<?php
require_once 'Model/Usuario.php';

class AuthController
{
    private $db;
    private $usuarioModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->usuarioModel = new Usuario($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_POST['usuario'] ?? '';
            $pass = $_POST['senha'] ?? '';

            // campos obrigatórios
            if (empty($user) || empty($pass)) {
                $_SESSION['erro'] = "Por favor, preencha todos os campos.";
                header("Location: index.php?action=login");
                exit();
            }

            // busca o usuário no banco pelo nome de usuário
            $dadosUsuario = $this->usuarioModel->buscarPorUsuario($user);

            // verifica se usuário existe e senha confere
            if ($dadosUsuario && $pass == $dadosUsuario['senha']) {
                // salvar login
                $_SESSION['usuario_id'] = $dadosUsuario['id'];
                $_SESSION['usuario_nome'] = $dadosUsuario['nome'];
                // redireciona para lista de clientes após login
                header("Location: index.php?action=listar");
                exit();
            } else {
                $_SESSION['erro'] = "Usuário ou senha incorretos!";
                header("Location: index.php?action=login");
                exit();
            }
        } else {
            include 'views/login.php';
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit(); 
    }

    public function recuperarSenha()
    {
        include 'views/recuperar_senha.php';
    }

    public function redefinirSenha() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = $_POST['usuario'] ?? '';
        $novaSenha = $_POST['nova_senha'] ?? '';

        if (empty($user) || empty($novaSenha)) {
            $_SESSION['erro'] = "Preencha todos os campos!";
            header("Location: index.php?action=recuperar");
            exit();
        }

        $dados = $this->usuarioModel->buscarPorUsuario($user);

        if ($dados) {
            $this->usuarioModel->atualizarSenha($user, $novaSenha);
            $_SESSION['sucesso'] = "Senha alterada com sucesso!";
            header("Location: index.php"); // volta para o login
        } else {
            $_SESSION['erro'] = "Usuário não encontrado no sistema!";
            header("Location: index.php?action=recuperar");
        }
        exit();
    } else {
        include 'views/recuperar_senha.php';
    }
}
}