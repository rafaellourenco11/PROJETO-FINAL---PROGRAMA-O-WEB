<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once("templetes/topo.php");
include_once("templetes/menu.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$mensagem = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once("conexao.php");

    $usuario_id = $_SESSION['usuario_id'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];

 
    if (!empty($data) && !empty($horario)) {
        
        $query = "INSERT INTO agendamentos (usuario_id, data, horario) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iss", $usuario_id, $data, $horario);

        
        if ($stmt->execute()) {
            $mensagem = "Agendamento realizado com sucesso!";
        } else {
            $mensagem = "Erro ao realizar o agendamento. Tente novamente.";
        }
    } else {
        $mensagem = "Por favor, preencha todos os campos.";
    }
}

?>

<div class="container">
    <h2>Agendar Serviço</h2>

    <?php if ($mensagem): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>

    <form action="agendeagora.php" method="POST">
        <div class="form-group">
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="horario">Horário:</label>
            <input type="time" id="horario" name="horario" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Agendar</button>
    </form>

    <?php if ($mensagem): ?>
        <a href="index.php" class="btn btn-primary">Voltar para o Início</a>
    <?php endif; ?>
</div>

<?php
include_once("templetes/rodape.php");
?>
