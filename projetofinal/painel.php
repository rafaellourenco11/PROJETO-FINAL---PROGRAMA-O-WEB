<?php
session_start();
require 'conexao.php'; 

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?msg=Você precisa estar logado para acessar essa página.");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];


$sql = "SELECT data, horario FROM agendamentos WHERE usuario_id = ? ORDER BY data, horario";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Painel do Cliente</title>
</head>
<body>
    <h1>Bem-vindo ao seu Painel</h1>
    
    <h2>Seus Agendamentos</h2>
    <?php if ($result->num_rows > 0): ?>
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($agendamento = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= date("d/m/Y", strtotime($agendamento['data'])) ?></td>
                        <td><?= date("H:i", strtotime($agendamento['horario'])) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Você ainda não possui agendamentos.</p>
        <a href="agendeagora.php" class="btn">Agendar Agora</a>
    <?php endif; ?>

    <p><a href="logout.php" class="btn">Sair</a></p>
    <p><a href="index.php" class="btn">Voltar</a></p>
</body>
</html>
