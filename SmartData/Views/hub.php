<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Menu Principal - SmartData</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php include 'views/menu.php'; ?>

<div class="container" style="text-align: center;">
    <h1 style="margin-bottom: 30px; color: #2c3e50;">Bem-vindo ao Painel</h1>
    <p style="color: #7f8c8d; margin-bottom: 40px;">Escolha uma das opções abaixo para gerenciar o sistema.</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
        
        <a href="index.php?action=listar" class="card-link">
            <div class="card">
                <span style="font-size: 2rem;">📂</span>
                <h3>Listar Clientes</h3>
                <p>Visualize seus clientes cadastrados.</p>
            </div>
        </a>

        <a href="index.php?action=novo" class="card-link">
            <div class="card">
                <span style="font-size: 2rem;">➕</span>
                <h3>Novo Cliente</h3>
                <p>Adicione um novo cliente.</p>
            </div>
        </a>

        <a href="index.php?action=logout" class="card-link">
            <div class="card card-exit">
                <span style="font-size: 2rem;">🚪</span>
                <h3>Sair</h3>
                <p>Encerre sua sessão.</p>
            </div>
        </a>

    </div>
</div>

</body>
</html>