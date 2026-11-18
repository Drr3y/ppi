<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel - To-Do List</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
        }
        .modal-conteudo {
            background: white;
            width: min(400px, calc(100% - 40px));
            margin: 150px auto;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <h1>Bem-vindo ao painel, <?= htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8') ?>!</h1>
    <p><a href="index.php?action=logout">Sair</a></p>

    <hr>

    <?php include __DIR__ . '/listar.php'; ?>
</body>
</html>
