<nav style="background-color: #333; padding: 10px; text-align: center;">
    <a href="index.php?action=menu" style="color: white; text-decoration: none; font-weight: bold; font-size: 1.2rem;">
        ☰ MENU PRINCIPAL
    </a>
</nav>
<br>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
<?php if (isset($_SESSION['erro'])): ?>
    Swal.fire({
        icon: 'error',
        title: 'Atenção',
        text: '<?php echo $_SESSION['erro']; ?>',
        confirmButtonColor: '#2c3e50'
    });
    <?php unset($_SESSION['erro']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['sucesso'])): ?>
    Swal.fire({
        icon: 'success',
        title: 'Feito!',
        text: '<?php echo $_SESSION['sucesso']; ?>',
        confirmButtonColor: '#27ae60'
    });
    <?php unset($_SESSION['sucesso']); ?>
<?php endif; ?>
</script>