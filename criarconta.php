<?php

include 'keyauth.php';
include 'credentials.php';

if (isset($_SESSION['user_data'])) {
    header("Location: dashboard/");
    exit();
}

$KeyAuthApp = new KeyAuth\api($name, $ownerid);

if (!isset($_SESSION['sessionid'])) {
    $KeyAuthApp->init();
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criar Conta</title>
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="assets/images/" type="image/x-icon">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="login-container">
        <h2>Criar Conta</h2>
        <form action="" method="POST"> 
            <div class="form-group">
                <label for="username">Nome de Usuário</label>
                <input type="password" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="license">Chave de Licença</label>
                <input type="password" id="license" name="license" required>
            </div>
            <button type="submit" class="btn" name="register">Registrar</button>
        </form>
        <p class="link-text">Já tem uma conta? <a href="login.php">Entrar</a></p>
        <p class="link-text">Voltar para <a href="index.html">home</a></p>
    </div>

    <?php
    
    if (isset($_POST['register'])) {
        if ($KeyAuthApp->register($_POST['username'], $_POST['password'], $_POST['license'])) {
            echo "<meta http-equiv='Refresh' Content='2; url=dashboard/'>";
            $KeyAuthApp->success("Conta criada com sucesso!");
        } else {
            $KeyAuthApp->error("Falha ao criar conta. Verifique os detalhes.");
        }
    }
    
    ?>

</body>
</html>
