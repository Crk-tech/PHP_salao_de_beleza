<?php

    session_start();
    $carrinho = $_SESSION["carrinho"] ?? [];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ic's Hair - Carrinho</title>
    <link href="img/logo.png" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen">
</head>
<body>
    <div class="container-fluid"><br>

        <div class="w-75 mx-auto d-flex justify-content-between align-items-center p-3 shadow rounded mb-3 " id="menu-inicial">
                <div>
                    <img src="img/logo.png" alt="logo" class="menu-logo">
                    <strong class="ms-2">Ic's Hair</strong>
                </div>
                <div>
                    <a href="index.html" class="me-3 text-dark">Menu</a>
                    <a href="carrinho.php" class="me-3 text-dark">Carrinho</a>
                    <a href="#" class="me-3 text-dark" data-bs-toggle="modal" data-bs-target="#whatsappModal">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
        </div><br>

        <div class="container">

            <div class="div-carrinho">
                    <span>CARRINHO</span>
            </div><br>

            <div>
                    <form action="" class="d-flex justify-content-center mb-4">
                        <input type="text" class="form-control form-pesquisa w-75" name="nome_Servico" placeholder="Digite o SERVIÇO para pesquisa"> <!-- w-75: 75% do tamanho do elemento pai -->
                        <input type="submit" value="Pesquisar" class="btn btn-pesquisa ms-2"> <!-- ms-2: margin de start/inicio tamanho 2 -->
                    </form>
            </div><br>
            
            <?php if (empty($carrinho)): ?>
                <p>Carrinho vazio.</p>
            <?php else: ?>
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>NOME</th>
                            <th>PROFISSIONAL</th>
                            <th>SERVIÇO</th>
                            <th>DATA</th>
                            <th>HORA</th>
                            <th>EXCLUIR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("admin/banco.php");

                        function buscarPreco($con, $servico) {
                            $stmt = $con->prepare("SELECT preco FROM servico WHERE nome_Servico = ?");
                            $stmt->bind_param("s", $servico);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $dado = $result->fetch_assoc();
                            return $dado ? $dado["preco"] : 0.00;
                        }

                        if (!isset($_SESSION['carrinho'])) {
                            $_SESSION['carrinho'] = array();
                        }

                        $nome_Servico = "";

                        if (isset($_GET["nome_Servico"])) {
                            $nome_Servico = strtolower(trim($_GET["nome_Servico"]));
                        }

                        $total = 0.0;

                        foreach ($carrinho as $index => $item) {
                            if ($nome_Servico !== "" && strpos(strtolower($item["nome_Servico"]), $nome_Servico) === false) {
                                continue;
                            }

                            $preco = buscarPreco($con, $item["nome_Servico"]);
                            $total += $preco;

                            echo "<tr>
                                    <td>" . htmlspecialchars($item["nome_Cliente"]) . "</td>
                                    <td>" . htmlspecialchars($item["nome_Profissional"]) . "</td>
                                    <td>" . htmlspecialchars($item["nome_Servico"]) . " - R$" . number_format($preco, 2, ',', '.') . "</td>
                                    <td>" . htmlspecialchars($item["data_Agenda"]) . "</td>
                                    <td>" . htmlspecialchars($item["hora"]) . "</td>
                                    <td><a href='remover_agendamento.php?index=$index' class='btn btn-danger'>Remover</a></td>
                                </tr>";
                        }

                        echo "</tbody></table>";

                        echo '<div class="text-end fw-bold fs-5 me-2">
                                Total: R$ ' . number_format($total, 2, ',', '.') . '
                            </div><br>';
                        ?>
                    </tbody>
                </table>
                <form action="finalizar_agendamento.php" method="post">
                    <input type="submit" value="FINALIZAR AGENDAMENTO" class="btn btn-warning"><br>
                </form>
            <?php endif; ?>
            <a href="agendamento.php" class="btn btn-warning">VOLTAR</a>
        </div>

        
    </div><br><br><br>

    <!-- WHATSAPP -->
    <div class="modal fade" id="whatsappModal" tabindex="-1" aria-labelledby="whatsappModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <div class="modal-header bg-purple text-white">
            <h5 class="modal-title" id="whatsappModalLabel">Entre em Contato:</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>

        <div class="modal-body text-center">
            <img src="img/whatsapp.png" alt="QRcode WhatsApp" class="img-fluid mb-3" style="max-height: 250px;">
            <div class="mb-3">
            <a href="https://wa.me/5514982015014" target="_blank" class="btn btn-success w-100">
                <i class="fab fa-whatsapp me-2"></i>Clique aqui e fale conosco!
            </a>
            </div>
            <p class="mb-0">Via WhatsApp</p>
        </div>

        </div>
    </div>
    </div>

    <footer class="text-white py-4 rodape">
        <div class="container">
            <div class="row">
                <!-- primeira divisão -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-uppercase">Ic's Hair</h5>
                    <p style="font-family: Arial, sans-serif;">
                        Transformamos beleza em arte. Agende seu horário e descubra uma nova versão de você.
                    </p>
                </div>

                <!-- segunda divisão -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-uppercase">Contato</h5>
                    <p><i class="fa-solid fa-phone me-2"></i>(14) 93352-0916</p>
                    <p><i class="fa-brands fa-whatsapp me-2"></i>WhatsApp: (14) 93352-0916</p>
                    <p><i class="fa-solid fa-envelope me-2"></i>contato@icshair.com</p>
                </div>

                <!-- terceira divisão -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-uppercase">Redes Sociais</h5>
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-tiktok fa-lg"></i></a>
                </div>
            </div>

            <hr class="border-light">

            <div class="text-center small">
                &copy; 2025 Ic's Hair. Todos os direitos reservados.
            </div>
        </div>
    </footer>
</body>
</html>