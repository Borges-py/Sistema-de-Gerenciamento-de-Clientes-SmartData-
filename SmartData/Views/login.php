<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - SmartData</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .login-body { height: 100vh; display: flex; align-items: center; justify-content: center; background-color: #f4f7f6; }
        .login-card { width: 100%; max-width: 350px; padding: 40px; text-align: center; background: white; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
    </style>
</head>
<body class="login-body">

<div class="login-card">
    <h2 style="margin-bottom: 20px; color: #2c3e50;">SmartData</h2>
    
    <?php include 'views/mensagens.php'; ?>

    <form action="index.php?action=login" method="POST">
        <input type="text" name="usuario" placeholder="Usuário" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Entrar</button>
    </form>
    
    <div style="margin-top: 20px;">
        <a href="index.php?action=recuperar" style="font-size: 0.9rem; color: #7f8c8d; text-decoration: none;">Esqueci minha senha</a>
    </div>
</div>

</body>
</html>