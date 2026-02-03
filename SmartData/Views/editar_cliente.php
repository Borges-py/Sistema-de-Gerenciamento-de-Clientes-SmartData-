<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Editar Cliente - SmartData</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-masker/1.1.0/vanilla-masker.min.js"></script>
</head>

<body>
    <?php include 'views/menu.php'; ?>

    <div class="container" style="max-width: 600px;">
        <h2 style="margin-bottom: 25px; color: #2c3e50;">Editar Dados do Cliente</h2>

        <form action="index.php?action=atualizar" method="POST">
            <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

            <div class="form-group">
                <label>Nome Completo</label>
                <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>" required pattern="[A-Za-zÀ-ÿ\s]+" title="Apenas letras e espaços são permitidos.">
            </div>

            <div class="form-group">
                <label>CPF</label>
                <input type="text" id="cpf" name="cpf" value="<?php echo $cliente['cpf']; ?>" placeholder="000.000.000-00" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                    title="Digite o CPF no formato: 000.000.000-00">
            </div>

            <div style="display: flex; gap: 15px;">
                <div class="form-group" style="flex: 1;">
                    <label>Telefone</label>
                    <input type="text" id="telefone" name="telefone" value="<?php echo $cliente['telefone']; ?>" required pattern="\(\d{2}\) \d{5}-\d{4}" title="Formato exigido: (00) 00000-0000">
                </div>
                <div class="form-group" style="flex: 1;">
                    <label>E-mail</label>
                    <input type="email" name="email" value="<?php echo $cliente['email']; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Endereço</label>
                <textarea name="endereco" required><?php echo $cliente['endereco']; ?></textarea>
            </div>

            <div style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary">Atualizar Dados</button>
                <a href="index.php?action=listar" class="btn" style="background: #eee; color: #333;">Voltar</a>
            </div>
        </form>
    </div>

    <script>
        // seguindo o tópico de tratamento de erros:
        VMasker(document.getElementById("cpf")).maskPattern("999.999.999-99");
        VMasker(document.getElementById("telefone")).maskPattern("(99) 99999-9999");
    </script>
</body>
</html>

<?php include 'views/mensagens.php'; ?>