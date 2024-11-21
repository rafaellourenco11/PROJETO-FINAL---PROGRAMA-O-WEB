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

                $dados = "\nNome: " . $nome . "\nE-mail: " . $email . "\nMensagem: " . $mensagem . "\n\n";
                $arquivo = "dadosformulario.txt";

                $handle = fopen($arquivo, "a");

                if ($handle) {
                    fwrite($handle, $dados);
                    fclose($handle);
                    echo "<p>Dados salvos com sucesso!</p>";
                } else {
                    echo "<p>Erro ao abrir o arquivo.</p>";
                }
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
