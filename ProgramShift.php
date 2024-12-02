<?php
    // Configuração de conexão com o banco de dados
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'programshiftdb';

    // Conectar ao banco de dados
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // Verificar conexão
    if ($conexao->connect_errno) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Inicializar a variável de erro
    $mensagemErro = "";

    // Verificar se o formulário foi enviado
    if (isset($_POST['submit'])) {
        // Sanitizar os dados do formulário para evitar injeções SQL
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

        // Consultar o banco de dados para verificar se o email existe
        $sql = "SELECT * FROM cadastros WHERE Email = '$email'";
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            // Se o email for encontrado, pegar os dados do usuário
            $row = $result->fetch_assoc();

            // Verificar se a senha inserida corresponde à senha criptografada no banco de dados
            if (password_verify($senha, $row['Senha'])) {
                // Armazenando as informações na sessão para redirecionar
                session_start();
                $_SESSION['email'] = $email; // Armazenando o email na sessão
                $_SESSION['nome'] = $row['Name']; // Armazenando o nome na sessão
                // Redirecionar para a página programshiftport.php após login bem-sucedido
                echo "<script>window.location.href = 'programshiftport.php';</script>";
                exit();
            } else {
                $mensagemErro = "Senha incorreta.";
            }
        } else {
            $mensagemErro = "Email não encontrado.";
        }
    }
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/Reset.css">
    <link rel="stylesheet" href="css/Progamshift.css">
    
    <title>ProgramShift</title>
</head>

<body>
    <header>
        <a href="ProgramShift.php">
            <img src="Progamshift.png" width="35" height="35">

            ProgramShift
        </a>
    </header>

    <div class="Prin">
        <div class="Sect">
            Bem-vindo ao nosso site. Por favor, faça login para acessar sua conta.
        </div>

        <div class="Sect">
            <p><strong>Login</strong></p>

            <!-- Formulário de Login -->
            <form action="ProgramShift.php" method="POST">
                <div class="Sepa">
                    <lable for="email">Email</lable><br>
                    <input type="email" name="email" id="Email" required><br>
                </div>

                <div class="Sepa">
                    <lable for="senha">Senha</lable><br>
                    <input type="password" name="senha" id="Senha" required><br>
                </div>
                
                <!-- Botão de envio -->
                <div class="Sepa">
                    <input type="submit" name="submit" value="Entrar">
                </div>
            </form>

            <!-- Mensagem de erro (se houver) -->
            <?php if ($mensagemErro): ?>
                <p style="color: red;"><?php echo $mensagemErro; ?></p>
            <?php endif; ?>

            <a href="php/ProgramShiftCadastro.php">Cadastrar-se</a>
        </div>
    </div>
</body>
</html>
