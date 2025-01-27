<?php
include('../Entity/Funcionario.php'); // Inclui o Model (Banco de dados)

// Variáveis para armazenar as mensagens de erro
$emailError = '';
$senhaError = '';
$loginError = '';

if (isset($_POST['email']) && isset($_POST['senha'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Validação simples
    if (strlen($email) == 0) {
        $emailError = "Preencha seu email.";
    } else if (strlen($senha) == 0) {
        $senhaError = "Preencha sua senha.";
    }

    // Instancia o Model
    $funcionario = new Funcionario();
    $usuario = $funcionario->verificarLogin($email, $senha);

    if ($usuario) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['id'] = $usuario['id'];
        header("Location: painel.php");
        exit();
    } else {
        $loginError = "Falha ao logar! E-mail ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peças BMW</title>
    <link rel="stylesheet" href="../public/css/login.css">
</head>
<body>
    <main>
        <div class="tela-login">
            <div class="container-img">
                <img src="../public/assets/BMW E30.jpg" alt="">
            </div>
            <div class="container-login">
                <div class="card-login">
                    <h1>Acesse sua conta</h1>
                    
                    <!-- Exibindo mensagens de erro -->
                    <?php if ($emailError): ?>
                        <div class="error-message"><?= $emailError ?></div>
                    <?php elseif ($senhaError): ?>
                        <div class="error-message"><?= $senhaError ?></div>
                    <?php elseif ($loginError): ?>
                        <div class="error-message"><?= $loginError ?></div>
                    <?php endif; ?>


                    <form action="" method="POST">
                        <label>Email</label>
                        <input type="text" name="email">
                        <label>Senha</label>
                        <input type="password" name="senha">
                        <br>
                        <input type="submit" value="ENTRAR"><br>
                        <button>CORPORATIVO</button>
                    </form>
                    <!-- <button>CORPORATIVO</button> -->
                </div>
            </div>
        </div>
    </main>
</body>
</html>