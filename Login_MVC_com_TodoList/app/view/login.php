<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login MVC</title>
</head>
<body>
    <h1>Acesse sua conta</h1>

    <?php if (isset($erro)): ?>
        <p style="color: red;">
            <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <form action="index.php?action=autenticar" method="POST">
        <p>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>
        </p>
        <p>
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>
        </p>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
