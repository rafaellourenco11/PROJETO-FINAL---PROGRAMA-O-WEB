<?php
session_start();

include_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    
    if (empty($nome) || empty($email) || empty($senha)) {
        echo "Todos os campos são obrigatórios!";
        exit();
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $query = "INSERT INTO clientes (nome, email, senha) VALUES (?, ?, ?)";

  
    if ($stmt = $conn->prepare($query)) {

        $stmt->bind_param("sss", $nome, $email, $senha_hash); 

        if ($stmt->execute()) {
            
            echo "Cadastro realizado com sucesso!";
        } else {
           
            echo "Erro ao cadastrar o cliente: " . $stmt->error;
        }

        $stmt->close();
    } else {
        
        echo "Erro ao preparar a consulta: " . $conn->error;
    }

    $conn->close();
}
?>
