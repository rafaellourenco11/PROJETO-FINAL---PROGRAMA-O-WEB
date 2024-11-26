<?php
session_start(); // Inicia a sessão
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redireciona para login se não estiver logado
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Opcional -->
</head>
<body>
    <h1>Bem-vindo ao Painel Administrativo</h1>
    <p>Olá, <?php echo $_SESSION['user']; ?>!</p>
    <a href="logout.php">Sair</a>
</body>
</html>
