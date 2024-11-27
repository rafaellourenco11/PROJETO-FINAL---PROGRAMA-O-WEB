<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {

    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $horario = $_POST['horario'];

    
    $conn = new mysqli("localhost", "root", "", "barbearia");

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $query = "INSERT INTO agendamentos (usuario_id, data, horario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $_SESSION['usuario_id'], $data, $horario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Agendamento realizado com sucesso!";
        echo '<br><br>';
        echo '<a href="index.php?pg=conteudo" class="btn btn-primary">Voltar para a tela inicial</a>'; // Botão de voltar
    } else {
        echo "Erro ao realizar o agendamento.";
    }

    $stmt->close();
    $conn->close();
}
?>
