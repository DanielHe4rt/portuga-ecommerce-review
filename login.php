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
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="assets/images/" type="image/x-icon">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="POST"> 
            <div class="form-group">
                <label for="email">Email</label> 
                <input type="password" id="email" name="username" required> 
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn" name="login">Entrar</button>
        </form>
        <p class="link-text">Voltar para <a href="index.html">home</a></p>
    </div>

    <?php
    
    if (isset($_POST['login'])) {
        // Login com username e password
        if ($KeyAuthApp->login($_POST['username'], $_POST['password'])) {
            echo "<meta http-equiv='Refresh' Content='2; url=dashboard/'>";
            $KeyAuthApp->success("Login realizado com sucesso!");
        } else {
            $KeyAuthApp->error("Falha no login. Verifique suas credenciais.");
        }
    }
    
    ?>

</body>
</html>
