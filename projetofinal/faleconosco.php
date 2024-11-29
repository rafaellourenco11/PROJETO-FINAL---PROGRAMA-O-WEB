<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
    <div>
        <h1>Formulário de Contato</h1>
        <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nome = $_REQUEST['nome'];
                $email = $_REQUEST['email'];
                $mensagem = $_REQUEST['mensagem'];

                $servername = "localhost"; 
                $username = "root";        
                $password = "";           
                $dbname = "barbearia";     

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Conexão falhou: " . $conn->connect_error);
                }

                $stmt = $conn->prepare("INSERT INTO contatos (nome, email, mensagem) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nome, $email, $mensagem);

                if ($stmt->execute()) {
                    echo "<p>Mensagem Enviada Com Sucesso!</p>";
                } else {
                    echo "<p>Erro ao enviar a mensagem: " . $conn->error . "</p>";
                }

                $stmt->close();
                $conn->close();
            }
        ?>

        <form method="post">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="mensagem">Mensagem:</label>
                <textarea id="mensagem" name="mensagem" required></textarea>
            </div>

            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>
