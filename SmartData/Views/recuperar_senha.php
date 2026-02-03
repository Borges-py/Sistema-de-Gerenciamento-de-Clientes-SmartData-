<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Recuperar Senha - SmartData</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="height: 100vh; display: flex; align-items: center; justify-content: center;">

<div class="container" style="max-width: 400px; text-align: center;">
    <h2 style="color: #2c3e50; margin-bottom: 15px;">Recuperar Senha</h2>
    <p style="color: #7f8c8d; margin-bottom: 25px; font-size: 0.9rem;">
        Informe seu usuário e escolha uma nova senha de acesso.
    </p>

    <form action="index.php?action=redefinir_senha" method="POST">
        <div class="form-group">
            <label>Usuário</label>
            <input type="text" name="usuario" placeholder="Ex: admin" required>
        </div>

        <div class="form-group">
            <label>Nova Senha</label>
            <input type="password" name="nova_senha" placeholder="Digite a nova senha" required>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">
            Redefinir Senha
        </button>
        
        <div style="margin-top: 20px;">
            <a href="index.php" style="text-decoration: none; color: #3498db; font-size: 0.9rem;">Voltar ao Login</a>
        </div>
    </form>
</div>

</body>
</html>

<?php if (isset($_SESSION['erro'])): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Ops...',
            text: '<?php echo $_SESSION['erro']; ?>',
            confirmButtonColor: '#3498db'
        });
    </script>
    <?php unset($_SESSION['erro']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['sucesso'])): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: '<?php echo $_SESSION['sucesso']; ?>',
            confirmButtonColor: '#27ae60'
        });
    </script>
    <?php unset($_SESSION['sucesso']); ?>
<?php endif; ?>