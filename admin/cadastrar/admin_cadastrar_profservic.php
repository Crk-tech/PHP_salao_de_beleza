<?php
include("../banco.php");

$query_servicos = "SELECT id_Servico, nome_Servico, preco FROM servico";
$resultado_servicos = mysqli_query($con, $query_servicos);

$query_profissionais = "SELECT id_Profissional, nome_Profissional FROM profissionais";
$resultado_profissionais = mysqli_query($con, $query_profissionais);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associar Serviço/Profissional </title>
    <link href="/salao-de-beleza/img/logo.png" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/salao-de-beleza/admin/admin_style.css" media="screen">
    <link href="img/perfil.png" rel="icon">
</head>
<body>
    
    <form action="admin_cadastrar_profservic_salvar.php" method="post">
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="p-4 bg-white rounded shadow">
                <div class="cabecalho">
                    <h1 id="cabecalho-cadastro">Associar Serviço/Profissional</h1>
                </div>
                <div>
                    <p>Qual Serviço e Profissional deseja associar:</p>
                    <label>Profissional</label><br>
                    <select name="id_Profissional" class="form-select" required>
                        <option value="">Selecione um Profissional</option>
                        <?php while ($row = mysqli_fetch_assoc($resultado_profissionais)) { ?>
                            <option value="<?php echo $row['id_Profissional']; ?>"> <?php echo $row['nome_Profissional']; ?> </option>
                        <?php } ?>
                    </select> 
                </div>
                <br>
                <div>
                    <label>Serviço</label><br>
                    <select name="id_Servico" class="form-select" required>
                        <option value="">Selecione um Serviço</option>
                        <?php while ($row = mysqli_fetch_assoc($resultado_servicos)) { ?>
                            <option value="<?php echo $row['id_Servico']; ?>">
                                <?php echo $row['nome_Servico'] . " - R$ " . number_format($row['preco'], 2, ',', '.'); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div><br>

                <div class="d-flex justify-content-center">
                    <input type="submit" value="Salvar" class="btn btn-dark botoes-cadastrar">
                    <a href="/salao-de-beleza/admin/consulta/admin_consulta_servicos_profissionais.php" class="btn btn-secondary botoes-cadastrar">VOLTAR</a>
                </div>
                
            </div>
        </div>
        
    </form>

    <footer class="text-center mt-4 mb-2 text-muted small">
        © 2025 Ic's Hair. Todos os direitos reservados.
    </footer>
</body>
</html>
