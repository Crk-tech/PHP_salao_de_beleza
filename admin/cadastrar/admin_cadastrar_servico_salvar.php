<?php

$nome_Servico = @$_POST["nome_Servico"]; 
$preco = @$_POST["preco"];

if ($nome_Servico == '' || $preco == '') {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Erro ao Cadastrar</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link href="/salao-de-beleza/img/logo.png" rel="icon">
    </head>
    <body class="bg-light">
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="alert alert-danger text-center w-75" role="alert">
                <?php
                if ($nome_Servico == '') {
                    echo "⚠️ <strong>Nome do Serviço</strong> é obrigatório.<br>";
                }
                if ($preco == '') {
                    echo "⚠️ <strong>Preço</strong> é obrigatório.<br>";
                }
                ?>
                <a href="/salao-de-beleza/admin/consulta/admin_consulta_servicos.php" class="btn btn-outline-danger mt-3">Voltar</a>
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

include("../banco.php"); 

$sql = "INSERT INTO servico (nome_Servico, preco)
        VALUES 
        ('$nome_Servico','$preco')";

$con->query($sql);

header('location: /salao-de-beleza/admin/consulta/admin_consulta_servicos.php');
?>
