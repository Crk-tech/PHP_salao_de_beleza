<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Profissional</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/salao-de-beleza/admin/admin_style.css" media="screen">
    <link href="/salao-de-beleza/img/logo.png" rel="icon">
</head>
<body>
    <form action="admin_cadastrar_profissional_salvar.php" method="post">
        <div class="d-flex justify-content-center align-items-center min-vh-100"> <!--justify-content-center: centraliza horizontalmente, align-items-center: centraliza verticalmente-->
            <div class="p-4 bg-white rounded shadow">
                
                <div class="cabecalho" >
                    <h2 id="cabecalho-cadastro">Casdastrar Novo Profissional</h2>
                </div>

                <div>
                    <p>Digite as informações do profissional abaixo:</p>
                    <span>Nome do profissional</span><br>
                    <input type="text" name="nome_Profissional" class="form-control w-100">
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <input type="submit" value="SALVAR" class="btn btn-dark botoes-cadastrar">
                    <a href="/salao-de-beleza/admin/consulta/admin_consulta_profissional.php" class="btn btn-secondary botoes-cadastrar">VOLTAR</a>
                </div>

            </div>
        </div>
    </form>

    <footer class="text-center mt-4 mb-2 text-muted small">
        © 2025 Ic's Hair. Todos os direitos reservados.
    </footer>
</body>
</html>