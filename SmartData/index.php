<?php
// habilita relatório de erros para debug durante desenvolvimento
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// conexão com banco e controllers
require_once 'Configuration/DataBase.php';
require_once 'Controllers/AuthController.php';
require_once 'Controllers/ClienteController.php';

// conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// o padrão vai ser sempre o 'login'
$action = $_GET['action'] ?? 'login';

// roteamento: direciona para o controller específico baseado na ação
switch ($action) {
    case 'login':
        $auth = new AuthController($db);
        $auth->login();
        break;

    case 'logout':
        $auth = new AuthController($db);
        $auth->logout();
        break;

    case 'recuperar':
        $auth = new AuthController($db);
        $auth->recuperarSenha();
        break;

    case 'redefinir_senha':
        $auth = new AuthController($db);
        $auth->redefinirSenha();
        break;

    case 'menu':
        include 'views/hub.php';
        break;

    case 'listar':
        $controller = new ClienteController($db);
        $controller->listar();
        break;

    case 'novo':
        $controller = new ClienteController($db);
        $controller->exibirFormularioCadastro();
        break;

    case 'salvar':
        $controller = new ClienteController($db);
        $controller->salvar();
        break;

    case 'editar':
        $controller = new ClienteController($db);
        $controller->editar();
        break;

    case 'atualizar':
        $controller = new ClienteController($db);
        $controller->atualizar();
        break;

    case 'excluir':
        $controller = new ClienteController($db);
        $controller->excluir();
        break;

    default:
        header("Location: index.php?action=login");
        break;
}