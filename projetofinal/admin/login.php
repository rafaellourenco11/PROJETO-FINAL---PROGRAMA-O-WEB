<?php
session_start(); // Inicia a sessão
include('../conexao.php'); // Inclui o arquivo de conexão com o banco

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $senha = md5($_POST['senha']); // Criptografa a senha com MD5

    // Consulta o banco para verificar as credenciais
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username AND senha = :senha");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['user'] = $username; // Armazena o usuário na sessão
        header("Location: dashboard.php"); // Redireciona para o painel administrativo
        exit;
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Painel Administrativo</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Opcional -->
</head>
<body>
    <h2>Login - Painel Administrativo</h2>
    <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>
    <form method="POST">
        <label for="username">Usuário:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
