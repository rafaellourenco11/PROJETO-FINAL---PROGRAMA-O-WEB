

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <nav class="menu">
        <ul>
            <li><a href="?pg=conteudo">Início</a></li>
            <li><a href="?pg=quemsomos">Quem Somos</a></li>
            <li><a href="?pg=faleconosco">Fale Conosco</a></li>

            <?php if (isset($_SESSION['usuario_id'])): ?>
                
                <li><a href="painel.php">Consultar Agendamentos</a></li>
                <li><a href="agendeagora.php">Agendar</a></li>
                <li><a href="logout.php">Sair</a></li>
            <?php else: ?>
                
                <li><a href="login.php">Login</a></li>
                <li><a href="cadastro.php">Cadastre-se</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</body>
</html>
