<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Cadastro de Cliente</title>
</head>
<body>
    <h1>Cadastro de Cliente</h1>
    <form id="formCadastro">
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit">Cadastrar</button>
        <a href="login.php" class="btn">Login</a>
        <a href="index.php" class="btn">Inicio</a>
    </form>

    <div id="mensagem"></div>

    <script>
    
        $(document).ready(function() {
    $("#formCadastro").submit(function(event) {
        event.preventDefault(); 
        
        var nome = $("#nome").val();
        var email = $("#email").val();
        var senha = $("#senha").val();
        
        if(nome == "" || email == "" || senha == "") {
            alert("Todos os campos são obrigatórios.");
            return false;
        }

        $.ajax({
            type: "POST",
            url: "processa_cadastro.php",
            data: { nome: nome, email: email, senha: senha },
            success: function(response) {
                $("#mensagem").html(response);
            }
        });
    });
});

    </script>
</body>
</html>
