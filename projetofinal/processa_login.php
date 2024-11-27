<?php
session_start();

include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        echo "<p>Por favor, preencha todos os campos.</p>";
    } else {
        $query = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email); 
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $nome, $senha_bd);
            $stmt->fetch();
            
            if (password_verify($senha, $senha_bd)) {
                $_SESSION['usuario_id'] = $id;
                $_SESSION['usuario_nome'] = $nome;
                
                header("Location: index.php"); 
                exit();
            } else {
                echo "<p>Senha incorreta.</p>";
            }
        } else {
            echo "<p>Usuário não encontrado.</p>";
        }
        
        $stmt->close();
    }
}

$conn->close();
?>
