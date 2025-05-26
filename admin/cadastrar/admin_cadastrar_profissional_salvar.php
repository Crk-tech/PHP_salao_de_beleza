<?php

include("../banco.php"); 

$nome_Profissional = $_POST["nome_Profissional"];

if ($nome_Profissional == '') {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Erro ao Cadastrar</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link href="img/perfil.png" rel="icon">
    </head>
    <body class="bg-light">
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="alert alert-danger text-center w-75" role="alert">
                <?php
                if ($nome_Profissional == '') {
                    echo "⚠️ <strong>Nome</strong> é obrigatório.<br>";
                }
                ?>
                <a href="/salao-de-beleza/admin/cadastrar/admin_cadastrar_profissional.php" class="btn btn-outline-danger mt-3">Voltar</a>
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

$sql = "INSERT INTO profissionais (nome_Profissional) 
        VALUES ('$nome_Profissional')";

$con->query($sql);

header('location: /salao-de-beleza/admin/consulta/admin_consulta_profissional.php');
?>
