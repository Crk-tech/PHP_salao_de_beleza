<?php
    session_start();

    $usuarios = [
        'admin' => '1234',
        'joao' => 'senha123',
        'maria' => 'abc123'
    ];

// Valida camps  preenchidos
if (empty($_POST['usuario']) || empty($_POST['senha'])) {
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Erro ao Logar</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link href="/salao-de-beleza/img/logo.png" rel="icon">
    </head>
    <body class="bg-light">
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="alert alert-danger text-center w-75" role="alert">
                <?php
                    echo "⚠️ <strong>Preencha todos os campos.</strong><br>";
                ?>
                <a href="/salao-de-beleza/admin/login/index.php" class="btn btn-outline-danger mt-3">Voltar</a>
            </div>
        </div>
        <footer class="text-center mt-4 mb-2 text-muted small">
            © 2025 Ic's Hair. Todos os direitos reservados.
        </footer>
    </body>
</html>

<?php
    exit;
}

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Valida usuário e senha
if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $senha) {
    $_SESSION['usuario'] = $usuario;
    header("Location: /salao-de-beleza/admin/consulta/admin_consulta_agendamentos.php");
    exit;
} 

else {
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Erro ao Logar</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link href="/salao-de-beleza/img/logo.png" rel="icon">
    </head>
    <body class="bg-light">
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="alert alert-danger text-center w-75" role="alert">
                <?php
                    echo "⚠️ <strong>Usuário</strong> ou <strong>senha</strong> inválidos. <br>";
                ?>
                <a href="/salao-de-beleza/admin/login/index.php" class="btn btn-outline-danger mt-3">Voltar</a>
            </div>
        </div>
        <footer class="text-center mt-4 mb-2 text-muted small">
            © 2025 Ic's Hair. Todos os direitos reservados.
        </footer>
    </body>
</html>

<?php

    
}
?>
