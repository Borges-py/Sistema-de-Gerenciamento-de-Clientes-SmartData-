<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // verifica se existe uma mensagem de ERRO na tela
    <?php if (isset($_SESSION['erro'])): ?>
        Swal.fire({
            icon: 'error',
            title: 'Atenção',
            text: '<?php echo $_SESSION['erro']; ?>',
            confirmButtonColor: '#2c3e50'
        });
        <?php unset($_SESSION['erro']); ?> // remove a mensagem para não aparecer novamente ao atualizar
    <?php endif; ?>

    // verifica se existe uma mensagem de SUCESSO na tela
    <?php if (isset($_SESSION['sucesso'])): ?>
        Swal.fire({
            icon: 'success',
            title: 'Feito!',
            text: '<?php echo $_SESSION['sucesso']; ?>',
            confirmButtonColor: '#27ae60'
        });
        <?php unset($_SESSION['sucesso']); ?> // remove a mensagem
    <?php endif; ?>
</script>