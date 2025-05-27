<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ic's Hair - Login Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/salao-de-beleza/admin/admin_style.css" media="screen">
    <link href="/salao-de-beleza/img/logo.png" rel="icon">
</head>
<body>
    <form action="/salao-de-beleza/admin/login/valida_login.php" method="post">
        <div class="d-flex justify-content-center align-items-center min-vh-100 flex-column">

            <h1 class="titulo-login mb-4">Ic's Hair</h1>

            <div class="p-4 bg-white rounded shadow" style="min-width: 300px;">
                <div class="cabecalho">
                    <h2 id="cabecalho-cadastro">Login Admin</h2>
                </div>

                <div>
                    <p>Digite suas credenciais:</p>
                    <span>Usuário</span><br>
                    <input type="text" name="usuario" class="form-control w-100">
                </div>
                <div>
                    <span>Senha</span><br>
                    <input type="password" name="senha" class="form-control w-100">
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <input type="submit" value="ENTRAR" class="btn btn-dark botoes-cadastrar">
                </div>
            </div>
        </div>
    </form>

    <footer class="text-center mt-4 mb-2 text-muted small">
        © 2025 Ic's Hair. Todos os direitos reservados.
    </footer>
</body>
</html>