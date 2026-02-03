<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes - SmartData</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; }
        th, td { padding: 16px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; color: #2c3e50; }
        tr:hover { background-color: #f1f1f1; }
        .container { max-width: 1400px; margin: 0 auto; padding: 20px; }
    </style>
</head>
<body>

    <?php include 'views/menu.php'; ?>

    <div class="container">
        <?php include 'views/mensagens.php'; ?>

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Clientes Cadastrados</h2>
            <a href="index.php?action=novo" class="btn btn-success">+ Adicionar Cliente</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><strong><?= $cliente['nome'] ?></strong></td>
                        <td><?= $cliente['cpf'] ?></td>
                        <td><?= $cliente['email'] ?></td>
                        <td><?= $cliente['telefone'] ?></td>
                        <td><?= $cliente['endereco'] ?></td>
                        <td style="text-align: center;">
                            <a href="index.php?action=editar&id=<?= $cliente['id'] ?>" 
                               class="btn btn-primary" 
                               style="padding: 5px 10px; font-size: 0.8rem;">Editar</a>
                            
                            <a href="#" class="btn btn-danger" 
                               style="padding: 5px 10px; font-size: 0.8rem;"
                               onclick="confirmarExclusao(event, 'index.php?action=excluir&id=<?= $cliente['id'] ?>')">
                               Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
    function confirmarExclusao(event, url) {
        event.preventDefault();
        Swal.fire({
            title: 'Tem certeza?',
            text: "Esta ação não poderá ser desfeita!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#7f8c8d',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
    </script>
</body>
</html>