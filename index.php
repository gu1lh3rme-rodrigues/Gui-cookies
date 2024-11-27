<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="assets/logo.png" alt="Imagem de login" class="capa" style="width: 250px;">
        </div>
        <div class="form-container">
            <h1>Faça o seu login</h1>
            <form action="login_validate.php" method="post">
                <input type="text" name="username" placeholder="Digite o nome do usuário" required>
                <input type="password" name="password" placeholder="Digite a senha" required>
                <button class="btn-login">LOGIN</button>
                <?php if (isset($_GET['error'])): ?>
                    <span class="msg_error"> <i class="fas fa-exclamation-circle"></i> Tentativa Inválida</span>
                <?php endif; ?>
            </form>
        </div>
</body>

</html>