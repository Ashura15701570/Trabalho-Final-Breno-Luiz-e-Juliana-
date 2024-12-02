<?php
// Configuração de conexão com o banco de dados
$dbHost = 'Localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'programshiftdb';

// Conectar ao banco de dados
$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Verificar conexão
if ($conexao->connect_errno) {
    echo "Erro: " . $conexao->connect_error;
} 

// Verificar se o formulário foi enviado
if (isset($_POST['submit'])) {
    // Sanitizar os dados antes de usar
    // $nome = mysqli_real_escape_string($conexao, $_POST['Name']);
    // $email = mysqli_real_escape_string($conexao, $_POST['Email']);
    // $senha = mysqli_real_escape_string($conexao, $_POST['Senha']);
    // $telefone = mysqli_real_escape_string($conexao, $_POST['Telefone']);

    // Inserir dados no banco de dados
    $sql = "INSERT INTO cadastros (Name, Email, Senha, Telefone) 
            VALUES ('$nome', '$email', '$senha', '$telefone')";

    if ($conexao->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/Reset.css">
    <link rel="stylesheet" type="text/css" href="../css/Progamshift.css">

    <title>Cadastrar-se</title>
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
            <p><strong>Sigin</strong></p>
            
            <form action="ProgramShiftCadastro.php" method="POST" id="formCadastro">
                <div class="Sepa">
                    <lable for="name">Email</lable><br>
                    <input type="name" name="email" id="Name" required><br>
                </div>

                <div class="Sepa">
                    <lable for="email">Email</lable><br>
                    <input type="email" name="email" id="Email" required><br>
                </div>

                <div class="Sepa">
                    <lable for="senha">Senha</lable><br>
                    <input type="password" name="senha" id="Senha" required><br>
                </div>
                
                <div class="Sepa">
                    <lable for="telefone">Telefone</lable><br>
                    <input type="number" name="telefone" id="Telefone" required><br>
                </div>

                <input type="submit" name="submit" id="submit">

                <a href="Programshift.php" class="butaocadastrar">Voltar ao login</a>
            </form>
        </div>
    </div>
</body>

</html>
