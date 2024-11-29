<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: agendamento.php");  
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $conn = new mysqli("localhost", "root", "", "barbearia");

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $query = "SELECT id, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $senha_hash);

    if ($stmt->fetch() && password_verify($senha, $senha_hash)) {
        
        $_SESSION['usuario_id'] = $id;
        header("Location: agendeagora.php");  
    } else {
        $erro = "Email ou senha incorretos!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <h1 style="text-align: center;">Login</h1>

    <form method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        <button type="submit">Entrar</button>
        <a href="cadastro.php" class="btn">Cadastre-se</a>
        <a href="index.php" class="btn">Inicio</a>
    </form>

    <?php
    if (isset($erro)) {
        echo "<p style='color:red;'>$erro</p>";
    }
    ?>
</body>
</html>
