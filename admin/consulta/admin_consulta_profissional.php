<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ic's Hair - Consulta Profissionais</title>
    <link href="/salao-de-beleza/img/logo.png" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/salao-de-beleza/admin/admin_style.css" media="screen">
</head>
<body>
    <div class="container-fluid"><br>

        <div class="w-75 mx-auto d-flex justify-content-between align-items-center p-3 shadow rounded mb-3 " id="menu-inicial">
            <div>
                <img src="/salao-de-beleza/img/logo.png" alt="logo" class="menu-logo">
                <strong class="ms-2">Ic's Hair</strong>
            </div>
            <div>
                <a href="admin_consulta_servicos_profissionais.php" class="me-3 text-dark">Serviços/Profissionais</a>
                <a href="admin_consulta_profissional.php" class="me-3 text-dark">Profissionais</a>
                <a href="admin_consulta_servicos.php" class="me-3 text-dark">Serviços</a>
                <a href="admin_consulta_agendamentos.php" class="me-3 text-dark">Agendamentos</a>
            </div>
        </div><br>

        <div class="container">

            <div class="div-consultas">
                <span>PROFISSIONAIS</span>
            </div><br>

            <a href="/salao-de-beleza/admin/cadastrar/admin_cadastrar_profissional.php" class="btn btn-dark">Cadastrar</a><br><br>
            
            <div>
                <form action="admin_consulta_profissional.php" method="get" class="d-flex justify-content-center mb-4">
                    <input type="text" class="form-control form-pesquisa w-75" name="nome_Profissional" placeholder="Digite o NOME para pesquisa"> <!-- w-75: 75% do tamanho do elemento pai -->
                    <input type="submit" value="Pesquisar" class="btn btn-pesquisa ms-2"> <!-- ms-2: margin de start/inicio tamanho 2 -->
                </form>
            </div><br>

            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <td>Id Profissional</td>
                    <td>Profissional</td>
                    <td>DELETAR</td>
                    <td>EDITAR</td>
                </thead>
                <tbody>
                    <?php

                        $conexao = new mysqli(
                        "127.0.0.1", 
                        "root", 
                        "", //
                        "salao" 
                        );

                        $nome_Profissional = "";
                        if(isset($_GET["nome_Profissional"])){
                            $nome_Profissional = $_GET["nome_Profissional"];
                        }
                        $sql = "SELECT * FROM profissionais WHERE nome_Profissional LIKE '%$nome_Profissional%'";

                        $resultado = $conexao->query($sql);

                        echo "Foram encontrados $resultado->num_rows Funcionários <br>";

                        foreach($resultado as $linha){
                            echo "
                                <tr>
                                    <td>" . $linha['id_Profissional'] . "</td>
                                    <td>" . $linha['nome_Profissional'] . "</td>
                                    <td>
                                        <a href='/salao-de-beleza/admin/excluir/admin_excluir_profissional.php?id_Profissional=" . $linha['id_Profissional'] . "' class='btn btn-danger'>🗑️</a>
                                    </td>
                                    <td>
                                        <a href='/salao-de-beleza/admin/alterar/admin_alterar_profissional.php?id_Profissional=" . $linha['id_Profissional'] ."' class= 'btn btn-primary'>✏️</a>
                                    </td>
                                </tr>
                            ";
                        }

                    ?>
                </tbody>
            </table>
        </div>

    </div><br>

    <footer class="text-center mt-4 mb-2 text-muted small">
        © 2025 Ic's Hair. Todos os direitos reservados.
    </footer>
</body>
</html>